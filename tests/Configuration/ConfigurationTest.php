<?php

namespace App\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @uses Configuration
 */
class ConfigurationTest extends TestCase
{
    protected function setUp(): void
    {

    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionRoot()
    {
        $configuration = new Configuration();

        $this->assertEquals($configuration->get('root'), '/usr/bin/app');
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildDirectory()
    {
        $configuration = new Configuration();

        $this->assertEquals($configuration->get('build.directory'), '/usr/bin/app/.build');
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildFile()
    {
        $configuration = new Configuration();

        $this->assertEquals($configuration->get('build.file'), '/usr/bin/app/.build/package.zip');
    }
}
