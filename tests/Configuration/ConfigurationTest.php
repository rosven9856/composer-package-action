<?php

namespace App\Configuration;

use PHPUnit\Framework\TestCase;
class ConfigurationTest extends TestCase
{
    /**
     * @return void
     */
    public function testCheckDefaultOptions()
    {
        define('ROOT', '/tests');
        $configuration = new Configuration();

        $this->assertEquals($configuration->get('build.directory'), '/tests/.build');
    }
}
