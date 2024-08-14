<?php

namespace App\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @uses Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * @var string
     */
    private const string DEFAULT_ENV_GITHUB_WORKSPACE = '/usr/bin/app';

    /**
     * @var string
     */
    private const string DEFAULT_ENV_BUILD_DIRECTORY_NAME = '.build';

    /**
     * @var string
     */
    private const string DEFAULT_ENV_BUILD_FILE_NAME = 'package.zip';

    /**
     * @var string
     */
    private const string OTHER_ENV_GITHUB_WORKSPACE = '/app';

    /**
     * @var string
     */
    private const string OTHER_ENV_BUILD_DIRECTORY_NAME = '.build_directory';

    /**
     * @var string
     */
    private const string OTHER_ENV_BUILD_FILE_NAME = 'build_file.zip';

    protected Configuration $configuration;

    #[\Override]
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
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('root'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildDirectory()
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('build.directory'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckDefaultOptionBuildFile()
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        $this->assertEquals(
            $configuration->get('build.file'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME .
             DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_FILE_NAME
        );
    }

    /**
     * @covers Configuration::get
     * @return void
     */
    public function testCheckOtherOptionRoot()
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

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
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

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
