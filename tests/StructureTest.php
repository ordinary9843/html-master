<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Structure;
use Ordinary9843\Constants\StructureConstant;

class StructureTest extends TestCase
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
    public function testShouldArrayHasKeyWhenGet(): void
    {
        $structure = new Structure();
        $structure = $structure->get();
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
    public function testShouldEqualsWhenGetTitle(): void
    {
        $structure = new Structure();
        $title = 'title';
        $structure->setTitle($title);
        $this->assertEquals($title, $structure->getTitle());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetDescription(): void
    {
        $structure = new Structure();
        $description = 'description';
        $structure->setDescription($description);
        $this->assertEquals($description, $structure->getDescription());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaCharset(): void
    {
        $structure = new Structure();
        $metaCharset = 'meta-charset';
        $structure->setMetaCharset($metaCharset);
        $this->assertEquals($metaCharset, $structure->getMetaCharset());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaKeywords(): void
    {
        $structure = new Structure();
        $metaKeywords = 'meta-keyword-a, meta-keyword-b, meta-keyword-c';
        $structure->setMetaKeywords($metaKeywords);
        $this->assertEquals($metaKeywords, $structure->getMetaKeywords());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaDescription(): void
    {
        $structure = new Structure();
        $metaDescription = 'meta-description';
        $structure->setMetaDescription($metaDescription);
        $this->assertEquals($metaDescription, $structure->getMetaDescription());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaViewport(): void
    {
        $structure = new Structure();
        $metaViewport = 'meta-viewport';
        $structure->setMetaViewport($metaViewport);
        $this->assertEquals($metaViewport, $structure->getMetaViewport());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaAuthor(): void
    {
        $structure = new Structure();
        $metaAuthor = 'meta-author';
        $structure->setMetaAuthor($metaAuthor);
        $this->assertEquals($metaAuthor, $structure->getMetaAuthor());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaCopyright(): void
    {
        $structure = new Structure();
        $metaCopyright = 'meta-copyright';
        $structure->setMetaCopyright($metaCopyright);
        $this->assertEquals($metaCopyright, $structure->getMetaCopyright());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaRobots(): void
    {
        $structure = new Structure();
        $metaRobots = 'meta-robots';
        $structure->setMetaRobots($metaRobots);
        $this->assertEquals($metaRobots, $structure->getMetaRobots());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaOg(): void
    {
        $structure = new Structure();
        $structure->setMetaOg('og:title', 'facebook-title');
        $this->assertEquals([
            'og:title' => 'facebook-title',
        ], $structure->getMetaOg());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMetaTwitter(): void
    {
        $structure = new Structure();
        $structure->setMetaTwitter('twitter:card', 'summary');
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $structure->getMetaTwitter());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetIcons(): void
    {
        $structure = new Structure();
        $icons = [
            'http://test.com/a.ico',
            'http://test.com/b.ico',
            'http://test.com/c.ico',
        ];
        $structure->setIcons($icons);
        $this->assertEquals($icons, $structure->getIcons());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetImages(): void
    {
        $structure = new Structure();
        $images = [
            'http://test.com/a.jpg',
            'http://test.com/b.jpeg',
            'http://test.com/c.png',
        ];
        $structure->setImages($images);
        $this->assertEquals($images, $structure->getImages());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetCss(): void
    {
        $structure = new Structure();
        $css = [
            'http://test.com/a.css',
            'http://test.com/b.css',
            'http://test.com/c.css',
        ];
        $structure->setCss($css);
        $this->assertEquals($css, $structure->getCss());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetJs(): void
    {
        $structure = new Structure();
        $js = [
            'http://test.com/a.js',
            'http://test.com/b.js',
            'http://test.com/c.js',
        ];
        $structure->setJs($js);
        $this->assertEquals($js, $structure->getJs());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetMeta(): void
    {
        $structure = new Structure();
        $keywords = 'meta-keyword-a, meta-keyword-b, meta-keyword-c';
        $description = 'meta-description';
        $viewport = 'meta-viewport';
        $author = 'meta-author';
        $copyright = 'meta-copyright';
        $robots = 'meta-robots';
        $structure->setMeta([
            StructureConstant::META_KEYWORDS => $keywords,
            StructureConstant::META_DESCRIPTION => $description,
            StructureConstant::META_VIEWPORT => $viewport,
            StructureConstant::META_AUTHOR => $author,
            StructureConstant::META_COPYRIGHT => $copyright,
            StructureConstant::META_ROBOTS => $robots,
            'og:title' => 'facebook-title',
            'twitter:card' => 'summary',
            'alternate' => 'http://test.com/alternate'
        ]);
        $this->assertEquals($keywords, $structure->getMetaKeywords());
        $this->assertEquals($description, $structure->getDescription());
        $this->assertEquals($viewport, $structure->getMetaViewport());
        $this->assertEquals($author, $structure->getMetaAuthor());
        $this->assertEquals($copyright, $structure->getMetaCopyright());
        $this->assertEquals($robots, $structure->getMetaRobots());
        $this->assertEquals([
            'og:title' => 'facebook-title',
        ], $structure->getMetaOg());
        $this->assertEquals([
            'twitter:card' => 'summary',
        ], $structure->getMetaTwitter());
    }

    /**
     * @return void
     */
    public function testShouldEqualsWhenGetStaticSources(): void
    {
        $structure = new Structure();
        $icons = [
            'http://test.com/a.ico',
            'http://test.com/b.ico',
            'http://test.com/c.ico',
        ];
        $images = [
            'http://test.com/a.jpg',
            'http://test.com/b.jpeg',
            'http://test.com/c.png',
        ];
        $css = [
            'http://test.com/a.css',
            'http://test.com/b.css',
            'http://test.com/c.css',
        ];
        $js = [
            'http://test.com/a.js',
            'http://test.com/b.js',
            'http://test.com/c.js',
        ];
        $structure->setStaticSources([
            StructureConstant::ICONS => $icons,
            StructureConstant::IMAGES => $images,
            StructureConstant::CSS => $css,
            StructureConstant::JS => $js
        ]);
        $this->assertEquals($icons, $structure->getIcons());
        $this->assertEquals($images, $structure->getImages());
        $this->assertEquals($css, $structure->getCss());
        $this->assertEquals($js, $structure->getJs());
    }
}
