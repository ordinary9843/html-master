<?php

namespace Ordinary9843;

use Ordinary9843\Constants\StructureConstant;

class Structure
{
    /** @var array */
    private $structure = [
        StructureConstant::TITLE => '',
        StructureConstant::DESCRIPTION => '',
        StructureConstant::META => [
            StructureConstant::META_CHARSET => '',
            StructureConstant::META_KEYWORDS => '',
            StructureConstant::META_DESCRIPTION => '',
            StructureConstant::META_VIEWPORT => '',
            StructureConstant::META_AUTHOR => '',
            StructureConstant::META_COPYRIGHT => '',
            StructureConstant::META_ROBOTS => '',
            StructureConstant::META_OG => [],
            StructureConstant::META_TWITTER => []
        ],
        StructureConstant::ICONS => [],
        StructureConstant::IMAGES => [],
        StructureConstant::CSS => [],
        StructureConstant::JS => []
    ];

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->structure;
    }

    /**
     * @param string $title
     * 
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->structure[StructureConstant::TITLE] = $title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->structure[StructureConstant::TITLE];
    }

    /**
     * @param string $description
     * 
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->structure[StructureConstant::DESCRIPTION] = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->structure[StructureConstant::DESCRIPTION];
    }

    /**
     * @param string $charset
     * 
     * @return void
     */
    public function setMetaCharset(string $charset): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_CHARSET] = $charset;
    }

    /**
     * @return string
     */
    public function getMetaCharset(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_CHARSET];
    }

    /**
     * @param string $keywords
     * 
     * @return void
     */
    public function setMetaKeywords(string $keywords): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_KEYWORDS] = $keywords;
    }

    /**
     * @return string
     */
    public function getMetaKeywords(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_KEYWORDS];
    }

    /**
     * @param string $description
     * 
     * @return void
     */
    public function setMetaDescription(string $description): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_DESCRIPTION] = $description;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_DESCRIPTION];
    }

    /**
     * @param string $viewport
     * 
     * @return void
     */
    public function setMetaViewport(string $viewport): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_VIEWPORT] = $viewport;
    }

    /**
     * @return string
     */
    public function getMetaViewport(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_VIEWPORT];
    }

    /**
     * @param string $author
     * 
     * @return void
     */
    public function setMetaAuthor(string $author): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_AUTHOR] = $author;
    }

    /**
     * @return string
     */
    public function getMetaAuthor(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_AUTHOR];
    }

    /**
     * @param string $copyright
     * 
     * @return void
     */
    public function setMetaCopyright(string $copyright): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_COPYRIGHT] = $copyright;
    }

    /**
     * @return string
     */
    public function getMetaCopyright(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_COPYRIGHT];
    }

    /**
     * @param string $robots
     * 
     * @return void
     */
    public function setMetaRobots(string $robots): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_ROBOTS] = $robots;
    }

    /**
     * @return string
     */
    public function getMetaRobots(): string
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_ROBOTS];
    }

    /**
     * @param string $name
     * @param string $content
     * 
     * @return void
     */
    public function setMetaOg(string $name, string $content): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_OG][$name] = $content;
    }

    /**
     * @return array
     */
    public function getMetaOg(): array
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_OG];
    }

    /**
     * @param string $name
     * @param string $content
     * 
     * @return void
     */
    public function setMetaTwitter(string $name, string $content): void
    {
        $this->structure[StructureConstant::META][StructureConstant::META_TWITTER][$name] = $content;
    }

    /**
     * @return array
     */
    public function getMetaTwitter(): array
    {
        return $this->structure[StructureConstant::META][StructureConstant::META_TWITTER];
    }

    /**
     * @param array $icons
     * 
     * @return void
     */
    public function setIcons(array $icons): void
    {
        $this->structure[StructureConstant::ICONS] = $icons;
    }

    /**
     * @return array
     */
    public function getIcons(): array
    {
        return $this->structure[StructureConstant::ICONS];
    }

    /**
     * @param array $images
     * 
     * @return void
     */
    public function setImages(array $images): void
    {
        $this->structure[StructureConstant::IMAGES] = $images;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->structure[StructureConstant::IMAGES];
    }

    /**
     * @param array $css
     * 
     * @return void
     */
    public function setCss(array $css): void
    {
        $this->structure[StructureConstant::CSS] = $css;
    }

    /**
     * @return array
     */
    public function getCss(): array
    {
        return $this->structure[StructureConstant::CSS];
    }

    /**
     * @param array $js
     * 
     * @return void
     */
    public function setJs(array $js): void
    {
        $this->structure[StructureConstant::JS] = $js;
    }

    /**
     * @return array
     */
    public function getJs(): array
    {
        return $this->structure[StructureConstant::JS];
    }

    /**
     * @param array $tags
     * 
     * @return void
     */
    public function setMeta(array $tags): void
    {
        foreach ($tags as $name => $content) {
            switch ($name) {
                case StructureConstant::META_KEYWORDS:
                    $this->setMetaKeywords($content);
                    break;
                case StructureConstant::META_DESCRIPTION:
                    $this->setDescription($content);
                    break;
                case StructureConstant::META_VIEWPORT:
                    $this->setMetaViewport($content);
                    break;
                case StructureConstant::META_AUTHOR:
                    $this->setMetaAuthor($content);
                    break;
                case StructureConstant::META_COPYRIGHT:
                    $this->setMetaCopyright($content);
                    break;
                case StructureConstant::META_ROBOTS:
                    $this->setMetaRobots($content);
                    break;
                case substr($name, 0, 3) === 'og:':
                    $this->setMetaOg($name, $content);
                    break;
                case substr($name, 0, 8) === 'twitter:':
                    $this->setMetaTwitter($name, $content);
                    break;
            }
        }
    }

    /**
     * @param array $tags
     * 
     * @return void
     */
    public function setStaticSources(array $tags): void
    {
        $mapping = [
            StructureConstant::ICONS => 'setIcons',
            StructureConstant::IMAGES => 'setImages',
            StructureConstant::CSS => 'setCss',
            StructureConstant::JS => 'setJs'
        ];
        foreach ($tags as $name => $content) {
            (isset($mapping[$name])) && $this->{$mapping[$name]}($content);
        }
    }
}
