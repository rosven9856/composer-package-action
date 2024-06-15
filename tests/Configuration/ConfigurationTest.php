<?php

namespace App\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @uses constant(ROOT)
 */
class ConfigurationTest extends TestCase
{
    protected function setUp(): void
    {
        define('ROOT', '/tests');
    }

    /**
     * @covers ROOT
     * @return void
     */
    public function testCheckDefaultOptions()
    {
        $configuration = new Configuration();

        $this->assertEquals($configuration->get('build.directory'), '/tests/.build');
    }
}
