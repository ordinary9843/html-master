<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Constants\MasterConstant;
use Ordinary9843\Constants\StructureConstant;
use Ordinary9843\HtmlMaster;

class HtmlMasterTest extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @return void
     */
    public function testShouldArrayHasKeyWhenParse(): void
    {
        $htmlMaster = new HtmlMaster();
        $urls = [
            'https://www.google.com',
            'https://www.youtube.com',
            'https://www.facebook.com'
        ];
        foreach ($urls as $url) {
            $structure = $htmlMaster->parse($url);
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
    }

    /**
     * @return void
     */
    public function testShouldNotEmptyMessagesWhenParse(): void
    {
        $htmlMaster = new HtmlMaster();
        shell_exec('rm -r -f ./browser/node_modules');
        $htmlMaster->setDebug(true);
        $htmlMaster->setExecutablePath('/usr/bin/test');
        $structure = $htmlMaster->parse('https://github.com/ordinary9843');
        $this->assertNotEmpty($structure);

        $htmlMaster->parse('google.com');
        $this->assertNotEmpty($htmlMaster->getMessages()[MasterConstant::MESSAGE_TYPE_ERROR]);

        $htmlMaster->parse('https://' . md5(uniqid()) . '.com');
        $this->assertNotEmpty($htmlMaster->getMessages()[MasterConstant::MESSAGE_TYPE_ERROR]);
    }
}
