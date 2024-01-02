<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MasterConstant;
use Ordinary9843\Constants\StructureConstant;
use Ordinary9843\Traits\MasterTrait;
use Exception;

class HtmlMaster extends Master
{
    use MasterTrait;

    /**
     * @return bool
     */
    private function isDynamic(): bool
    {
        $requires = ['node', 'npm', escapeshellarg($this->getExecutablePath())];
        foreach ($requires as $require) {
            if (empty(shell_exec($require . ' --version 2>/dev/null'))) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $url
     * 
     * @return string
     */
    private function parseHtml(string $url): string
    {
        if ($this->isDynamic()) {
            if (!is_dir('./browser/node_modules')) {
                $this->addMessage(MasterConstant::MESSAGE_TYPE_INFO, 'The `node_modules` directory does not exist. Installing related modules now.');
                shell_exec('cd ./browser && npm install');
                $this->addMessage(MasterConstant::MESSAGE_TYPE_INFO, 'Node related modules have been installed.');
            }

            $mapping = [
                '{executablePath}' => $this->getExecutablePath(),
                '{conectionTimeout}' => $this->getConnectTimeout(),
                '{waitSeconds}' => $this->getWaitSeconds(),
                '{userAgent}' => $this->getUserAgent(),
                '{url}' => $url
            ];
            $mappingKeys = array_keys($mapping);
            $command = 'node ./browser/index.js ' . implode(' ', $mappingKeys);
            $json = shell_exec(str_replace($mappingKeys, array_map('escapeshellarg', array_values($mapping)), $command));
            $result = json_decode($json, true);
            $html = $result['html'] ?? '';
        } else {
            $html = $this->getClient()->get($url, [
                'headers' => [
                    'User-Agent' => $this->getUserAgent()
                ]
            ])->getBody()->getContents();
        }

        return $html;
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    private function parseTitleFromTag(string $html): string
    {
        preg_match('/<title\s*>(.*?)<\/title>/i', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    private function parseDescriptionFromTag(string $html): string
    {
        preg_match('/<body[^>]*>(.*?)<\/body>/si', $html, $matches);
        $description = $matches[1] ?? '';
        if (!empty($description)) {
            $description = preg_replace('/<noscript[\s\S]*?>[\s\S]*?<\/noscript>/i', '', $description);
            $description = preg_replace('/<script[\s\S]*?>[\s\S]*?<\/script>/i', '', $description);
            $description = preg_replace('/<style[\s\S]*?>[\s\S]*?<\/style>/i', '', $description);
            $description = preg_replace('/\s+/', ' ', $description);
            $description = strip_tags($description);
        }

        return $description;
    }

    /**
     * @param string $html
     * 
     * @return string
     */
    private function parseCharsetFromTag(string $html): string
    {
        preg_match('/<meta\s+charset=["\']?(\w+-?\w*)["\']?\s*\/?>/i', $html, $matches);

        return $matches[1] ?? '';
    }

    /**
     * @param string $html
     * 
     * @return array
     */
    private function parseMetaFromTag(string $html): array
    {
        preg_match_all('/<meta\s[^>]*>/si', $html, $matches);
        $html = array_reduce($matches[0] ?? [], function ($result, $tag) {
            preg_match('/<meta\s+name="([^"]+)"\s+content="([^"]+)"\s*\/?>/si', $tag, $matches);
            $name = $matches[1] ?? '';
            $content = $matches[2] ?? '';
            ($name && $content) && $result[$name] = $content;

            return $result;
        }, []);

        return $html;
    }

    /**
     * @param string $url
     * @param string $html
     * 
     * @return array
     */
    private function parseStaticSourcesFromTag(string $url, string $html): array
    {
        preg_match_all('/<(link|script|img)[^>]*>/si', $html, $matches);
        $baseUrl = $this->parseBaseUrl($url);
        $staticSources = array_reduce($matches[0] ?? [], function ($result, $tag) use ($baseUrl) {
            if (substr($tag, 0, 5) === '<link') {
                preg_match('/<link.*?rel="(.*?)".*?href="(.*?)".*?>/si', $tag, $matches);
                $rel = $matches[1] ?? '';
                $href = trim($matches[2] ?? '', '/');
                if ($rel && $href) {
                    (!$this->hasScheme($href)) && $href = $baseUrl . $href;
                    if (strpos($rel, 'icon') !== false || in_array($rel, ['shortcut'])) {
                        $result[StructureConstant::ICONS][] = $href;
                    } elseif ($rel === 'stylesheet') {
                        $result[StructureConstant::CSS][] = $href;
                    }
                }
            } elseif (substr($tag, 0, 7) === '<script') {
                preg_match('/<script.*?src="(.*?)".*?>/si', $tag, $matches);
                $src = trim($matches[1] ?? '', '/');
                if ($src) {
                    (!$this->hasScheme($src)) && $src = $baseUrl . $src;
                    $result[StructureConstant::JS][] = $src;
                }
            } elseif (substr($tag, 0, 4) === '<img') {
                preg_match('/<img.*?src="(.*?)".*?>/si', $tag, $matches);
                $src = trim($matches[1] ?? '', '/');
                if ($src) {
                    (!$this->hasScheme($src)) && $src = $baseUrl . $src;
                    $result[StructureConstant::IMAGES][] = $src;
                }
            }

            return $result;
        }, [
            StructureConstant::ICONS => [],
            StructureConstant::IMAGES => [],
            StructureConstant::CSS => [],
            StructureConstant::JS => []
        ]);
        $staticSources[StructureConstant::ICONS] = array_values(array_unique($staticSources[StructureConstant::ICONS]));
        $staticSources[StructureConstant::IMAGES] = array_values(array_unique($staticSources[StructureConstant::IMAGES]));
        $staticSources[StructureConstant::CSS] = array_values(array_unique($staticSources[StructureConstant::CSS]));
        $staticSources[StructureConstant::JS] = array_values(array_unique($staticSources[StructureConstant::JS]));

        return $staticSources;
    }

    /**
     * @param string $url
     * 
     * @return array
     */
    public function parse(string $url): array
    {
        $structure = new Structure();

        try {
            if (!$this->isValidUrl($url)) {
                throw new Exception($url . ' is not a valid URL.');
            }

            $html = $this->parseHtml($url);
            if (!empty($html)) {
                $structure->setTitle($this->parseTitleFromTag($html));
                $structure->setDescription($this->parseDescriptionFromTag($html));
                $structure->setMetaCharset($this->parseCharsetFromTag($html));
                $structure->setMeta($this->parseMetaFromTag($html));
                $structure->setStaticSources($this->parseStaticSourcesFromTag($url, $html));
            }
        } catch (Exception $e) {
            $this->addMessage(MasterConstant::MESSAGE_TYPE_ERROR, $e->getMessage());
        }

        if ($this->getDebug()) {
            print_r($this->getMessages());
        }

        return $structure->get();
    }
}
