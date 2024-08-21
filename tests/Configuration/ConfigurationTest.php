<?php

declare(strict_types=1);

namespace App\Configuration;

use PHPUnit\Framework\TestCase;

/**
 * @uses \Configuration
 */
final class ConfigurationTest extends TestCase
{
    /**
     * @var string
     */
    private const string DEFAULT_ENV_GITHUB_WORKSPACE = '/usr/bin/app';

    /**
     * @var string
     */
    private const string DEFAULT_ENV_GITHUB_OUTPUT = '/usr/bin/app/var/outputcmd.txt';

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
    private const string OTHER_ENV_GITHUB_OUTPUT = '/usr/bin/app/var/otheroutputcmd.txt';

    /**
     * @var string
     */
    private const string OTHER_ENV_BUILD_DIRECTORY_NAME = '.build_directory';

    /**
     * @var string
     */
    private const string OTHER_ENV_BUILD_FILE_NAME = 'build_file.zip';

    // protected Configuration $configuration;

    #[\Override]
    protected function setUp(): void
    {
        // putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);

        // $this->configuration = new Configuration();
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckDefaultOptionGitHubWorkspace(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_WORKSPACE'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckDefaultGetRootDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->getRootDirectory(),
            self::DEFAULT_ENV_GITHUB_WORKSPACE,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckDefaultOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_OUTPUT'),
            self::DEFAULT_ENV_GITHUB_OUTPUT,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckDefaultOptionBuildDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.directory'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckDefaultOptionBuildFile(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::DEFAULT_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.file'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_DIRECTORY_NAME .
             \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_BUILD_FILE_NAME,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckOtherOptionOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_WORKSPACE'),
            self::OTHER_ENV_GITHUB_WORKSPACE,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckOtherGetRootDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->getRootDirectory(),
            self::OTHER_ENV_GITHUB_WORKSPACE,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckOtherOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_OUTPUT'),
            self::OTHER_ENV_GITHUB_OUTPUT,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckOtherOptionBuildDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.directory'),
            self::OTHER_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_DIRECTORY_NAME,
        );
    }

    /**
     * @covers \Configuration::get
     */
    public function testCheckOtherOptionBuildFile(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('BUILD_DIRECTORY_NAME=' . self::OTHER_ENV_BUILD_DIRECTORY_NAME);
        putenv('BUILD_FILE_NAME=' . self::OTHER_ENV_BUILD_FILE_NAME);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.file'),
            self::OTHER_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_DIRECTORY_NAME .
            \DIRECTORY_SEPARATOR . self::OTHER_ENV_BUILD_FILE_NAME,
        );
    }
}
