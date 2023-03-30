<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Structure;
use Ordinary9843\Constants\StructureConstant;

class StructureTest extends TestCase
{
    /** @var Structure */
    private $structure = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var Structure */
        $this->structure = new Structure();
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $structure = $this->structure->get();
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

    /**
     * @return void
     */
    public function testTitle(): void
    {
        $title = 'test-title';
        $this->structure->setTitle($title);
        $this->assertEquals($title, $this->structure->getTitle());
    }

    /**
     * @return void
     */
    public function testDescription(): void
    {
        $description = 'test-description';
        $this->structure->setDescription($description);
        $this->assertEquals($description, $this->structure->getDescription());
    }

    /**
     * @return void
     */
    public function testMetaCharset(): void
    {
        $metaCharset = 'test-meta-charset';
        $this->structure->setMetaCharset($metaCharset);
        $this->assertEquals($metaCharset, $this->structure->getMetaCharset());
    }

    /**
     * @return void
     */
    public function testMetaKeywords(): void
    {
        $metaKeywords = 'test-meta-keyword-a, test-meta-keyword-b, test-meta-keyword-c';
        $this->structure->setMetaKeywords($metaKeywords);
        $this->assertEquals($metaKeywords, $this->structure->getMetaKeywords());
    }

    /**
     * @return void
     */
    public function testMetaDescription(): void
    {
        $metaDescription = 'test-meta-description';
        $this->structure->setMetaDescription($metaDescription);
        $this->assertEquals($metaDescription, $this->structure->getMetaDescription());
    }

    /**
     * @return void
     */
    public function testMetaViewport(): void
    {
        $metaViewport = 'test-meta-viewport';
        $this->structure->setMetaViewport($metaViewport);
        $this->assertEquals($metaViewport, $this->structure->getMetaViewport());
    }

    /**
     * @return void
     */
    public function testMetaAuthor(): void
    {
        $metaAuthor = 'test-meta-author';
        $this->structure->setMetaAuthor($metaAuthor);
        $this->assertEquals($metaAuthor, $this->structure->getMetaAuthor());
    }

    /**
     * @return void
     */
    public function testMetaCopyright(): void
    {
        $metaCopyright = 'test-meta-copyright';
        $this->structure->setMetaCopyright($metaCopyright);
        $this->assertEquals($metaCopyright, $this->structure->getMetaCopyright());
    }

    /**
     * @return void
     */
    public function testRobots(): void
    {
        $metaRobots = 'test-meta-robots';
        $this->structure->setMetaRobots($metaRobots);
        $this->assertEquals($metaRobots, $this->structure->getMetaRobots());
    }

    /**
     * @return void
     */
    public function testOg(): void
    {
        $this->structure->setMetaOg('og:title', 'test-facebook-title');
        $this->assertEquals([
            'og:title' => 'test-facebook-title',
        ], $this->structure->getMetaOg());
    }

    /**
     * @return void
     */
    public function testTwitter(): void
    {
        $this->structure->setMetaTwitter('twitter:card', 'summary');
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $this->structure->getMetaTwitter());
    }

    /**
     * @return void
     */
    public function testIcons(): void
    {
        $icons = [
            'http://test.com/test-a.ico',
            'http://test.com/test-b.ico',
            'http://test.com/test-c.ico',
        ];
        $this->structure->setIcons($icons);
        $this->assertEquals($icons, $this->structure->getIcons());
    }

    /**
     * @return void
     */
    public function testImages(): void
    {
        $images = [
            'http://test.com/test-a.jpg',
            'http://test.com/test-b.jpeg',
            'http://test.com/test-c.png',
        ];
        $this->structure->setImages($images);
        $this->assertEquals($images, $this->structure->getImages());
    }

    /**
     * @return void
     */
    public function testCss(): void
    {
        $css = [
            'http://test.com/test-a.css',
            'http://test.com/test-b.css',
            'http://test.com/test-c.css',
        ];
        $this->structure->setCss($css);
        $this->assertEquals($css, $this->structure->getCss());
    }

    /**
     * @return void
     */
    public function testJs(): void
    {
        $js = [
            'http://test.com/test-a.js',
            'http://test.com/test-b.js',
            'http://test.com/test-c.js',
        ];
        $this->structure->setJs($js);
        $this->assertEquals($js, $this->structure->getJs());
    }

    /**
     * @return void
     */
    public function testMeta(): void
    {
        $keywords = 'test-meta-keyword-a, test-meta-keyword-b, test-meta-keyword-c';
        $description = 'test-meta-description';
        $viewport = 'test-meta-viewport';
        $author = 'test-meta-author';
        $copyright = 'test-meta-copyright';
        $robots = 'test-meta-robots';
        $this->structure->setMeta([
            StructureConstant::META_KEYWORDS => $keywords,
            StructureConstant::META_DESCRIPTION => $description,
            StructureConstant::META_VIEWPORT => $viewport,
            StructureConstant::META_AUTHOR => $author,
            StructureConstant::META_COPYRIGHT => $copyright,
            StructureConstant::META_ROBOTS => $robots,
            'og:title' => 'test-facebook-title',
            'twitter:card' => 'test-summary',
            'alternate' => 'http://test.com/alternate'
        ]);
        $this->assertEquals($keywords, $this->structure->getMetaKeywords());
        $this->assertEquals($description, $this->structure->getDescription());
        $this->assertEquals($viewport, $this->structure->getMetaViewport());
        $this->assertEquals($author, $this->structure->getMetaAuthor());
        $this->assertEquals($copyright, $this->structure->getMetaCopyright());
        $this->assertEquals($robots, $this->structure->getMetaRobots());
        $this->assertEquals([
            'og:title' => 'test-facebook-title',
        ], $this->structure->getMetaOg());
        $this->assertEquals([
            'twitter:card' => 'test-summary',
        ], $this->structure->getMetaTwitter());
    }

    /**
     * @return void
     */
    public function testStaticSources(): void
    {
        $icons = [
            'http://test.com/test-a.ico',
            'http://test.com/test-b.ico',
            'http://test.com/test-c.ico',
        ];
        $images = [
            'http://test.com/test-a.jpg',
            'http://test.com/test-b.jpeg',
            'http://test.com/test-c.png',
        ];
        $css = [
            'http://test.com/test-a.css',
            'http://test.com/test-b.css',
            'http://test.com/test-c.css',
        ];
        $js = [
            'http://test.com/test-a.js',
            'http://test.com/test-b.js',
            'http://test.com/test-c.js',
        ];
        $this->structure->setStaticSources([
            StructureConstant::ICONS => $icons,
            StructureConstant::IMAGES => $images,
            StructureConstant::CSS => $css,
            StructureConstant::JS => $js
        ]);
        $this->assertEquals($icons, $this->structure->getIcons());
        $this->assertEquals($images, $this->structure->getImages());
        $this->assertEquals($css, $this->structure->getCss());
        $this->assertEquals($js, $this->structure->getJs());
    }
}
