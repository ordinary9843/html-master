<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Ordinary9843\Master;

class MasterTest extends TestCase
{
    /** @var Master */
    private $master = null;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @var Master */
        $this->master = new Master();
    }

    /**
     * @return void
     */
    public function testDebug(): void
    {
        $debug = true;
        $this->master->setDebug($debug);
        $this->assertEquals($debug, $this->master->getDebug());
    }

    /**
     * @return void
     */
    public function testError(): void
    {
        $this->assertEmpty($this->master->getError());

        $error = 'test-error';
        $this->master->setError($error);
        $this->assertEquals([
            $error
        ], $this->master->getError());
    }
}
