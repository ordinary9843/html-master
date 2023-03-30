<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\HtmlMaster;
use Ordinary9843\Constants\StructureConstant;

class HtmlMasterTest extends TestCase
{
    /** @var HtmlMaster */
    private $htmlMaster = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var HtmlMaster */
        $this->htmlMaster = new HtmlMaster();
    }

    /**
     * @return void
     */
    public function testParse(): void
    {
        $urls = [
            'https://www.google.com',
            'https://www.youtube.com',
            'https://www.facebook.com'
        ];
        foreach ($urls as $url) {
            $structure = $this->htmlMaster->parse($url);
            $this->assertCount(7, $structure);
            $this->assertArrayHasKey(StructureConstant::TITLE, $structure);
            $this->assertArrayHasKey(StructureConstant::DESCRIPTION, $structure);
            $this->assertArrayHasKey(StructureConstant::META, $structure);
            $this->assertArrayHasKey(StructureConstant::META_CHARSET, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_KEYWORDS, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_DESCRIPTION, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_VIEWPORT, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_AUTHOR, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_COPYRIGHT, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_ROBOTS, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_OG, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::META_TWITTER, $structure[StructureConstant::META]);
            $this->assertArrayHasKey(StructureConstant::ICONS, $structure);
            $this->assertArrayHasKey(StructureConstant::IMAGES, $structure);
            $this->assertArrayHasKey(StructureConstant::CSS, $structure);
            $this->assertArrayHasKey(StructureConstant::JS, $structure);
        }

        shell_exec('rm -r -f ./browser/node_modules');
        $this->htmlMaster->setDebug(true);
        $this->htmlMaster->setExecutablePath('/usr/bin/test');
        $structure = $this->htmlMaster->parse('https://github.com/ordinary9843');
        $this->assertNotEmpty($structure);

        $this->htmlMaster->parse('google.com');
        $this->assertNotEmpty($this->htmlMaster->getError());

        $this->htmlMaster->parse('https://' . md5(uniqid()) . '.com');
        $this->assertNotEmpty($this->htmlMaster->getError());
    }
}
