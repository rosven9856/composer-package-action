<?php

namespace App\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @uses Configuration
 */
class ConfigurationTest extends TestCase
{
    const string DEFAULT_ENV_GITHUB_WORKSPACE = '/usr/bin/app';
    const string OTHER_ENV_GITHUB_WORKSPACE = '/app';
    const string OTHER_ENV_BUILD_DIRECTORY_NAME = '.build_directory';
    const string OTHER_ENV_BUILD_FILE_NAME = 'build_file.zip';

    protected Configuration $configuration;

    protected function setUp(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);

        $this->configuration = new Configuration();
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionRoot()
    {
        $this->assertEquals(
            $this->configuration->get('root'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildDirectory()
    {
        $this->assertEquals(
            $this->configuration->get('build.directory'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . '/.build'
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildFile()
    {
        $this->assertEquals(
            $this->configuration->get('build.file'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . '/.build/package.zip'
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckOtherOptionRoot()
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('root'),
            self::OTHER_ENV_GITHUB_WORKSPACE
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckOtherOptionBuildDirectory()
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('build.directory'),
            self::OTHER_ENV_GITHUB_WORKSPACE . DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_DIRECTORY_NAME
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckOtherOptionBuildFile()
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('build.file'),
            self::OTHER_ENV_GITHUB_WORKSPACE . DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_DIRECTORY_NAME .
            DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_FILE_NAME
        );
    }
}
