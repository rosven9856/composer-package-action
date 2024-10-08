<?php

declare(strict_types=1);

namespace App\Configuration;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Configuration::class)]
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
    private const string DEFAULT_ENV_DIRECTORY = '.build';

    /**
     * @var string
     */
    private const string DEFAULT_ENV_FILE = 'package.zip';

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
    private const string OTHER_ENV_DIRECTORY = '.build_directory';

    /**
     * @var string
     */
    private const string OTHER_ENV_FILE = 'build_file.zip';

    // protected Configuration $configuration;

    #[\Override]
    protected function setUp(): void
    {
        // putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);

        // $this->configuration = new Configuration();
    }

    public function testCheckDefaultOptionGitHubWorkspace(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::DEFAULT_ENV_DIRECTORY);
        putenv('file=' . self::DEFAULT_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_WORKSPACE'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE,
        );
    }

    public function testCheckDefaultGetRootDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::DEFAULT_ENV_DIRECTORY);
        putenv('file=' . self::DEFAULT_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->getRootDirectory(),
            self::DEFAULT_ENV_GITHUB_WORKSPACE,
        );
    }

    public function testCheckDefaultOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::DEFAULT_ENV_DIRECTORY);
        putenv('file=' . self::DEFAULT_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_OUTPUT'),
            self::DEFAULT_ENV_GITHUB_OUTPUT,
        );
    }

    public function testCheckDefaultOptionBuildDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::DEFAULT_ENV_DIRECTORY);
        putenv('file=' . self::DEFAULT_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.directory'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_DIRECTORY,
        );
    }

    public function testCheckDefaultOptionBuildFile(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::DEFAULT_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::DEFAULT_ENV_DIRECTORY);
        putenv('file=' . self::DEFAULT_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.file'),
            self::DEFAULT_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_DIRECTORY .
             \DIRECTORY_SEPARATOR . self::DEFAULT_ENV_FILE,
        );
    }

    public function testCheckOtherOptionOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::OTHER_ENV_DIRECTORY);
        putenv('file=' . self::OTHER_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_WORKSPACE'),
            self::OTHER_ENV_GITHUB_WORKSPACE,
        );
    }

    public function testCheckOtherGetRootDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::OTHER_ENV_DIRECTORY);
        putenv('file=' . self::OTHER_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->getRootDirectory(),
            self::OTHER_ENV_GITHUB_WORKSPACE,
        );
    }

    public function testCheckOtherOptionGitHubOutput(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::OTHER_ENV_DIRECTORY);
        putenv('file=' . self::OTHER_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('GITHUB_OUTPUT'),
            self::OTHER_ENV_GITHUB_OUTPUT,
        );
    }

    public function testCheckOtherOptionBuildDirectory(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::OTHER_ENV_DIRECTORY);
        putenv('file=' . self::OTHER_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.directory'),
            self::OTHER_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::OTHER_ENV_DIRECTORY,
        );
    }

    public function testCheckOtherOptionBuildFile(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::OTHER_ENV_GITHUB_WORKSPACE);
        putenv('GITHUB_OUTPUT=' . self::OTHER_ENV_GITHUB_OUTPUT);
        putenv('directory=' . self::OTHER_ENV_DIRECTORY);
        putenv('file=' . self::OTHER_ENV_FILE);

        $configuration = new Configuration();

        self::assertEquals(
            $configuration->get('build.file'),
            self::OTHER_ENV_GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . self::OTHER_ENV_DIRECTORY .
            \DIRECTORY_SEPARATOR . self::OTHER_ENV_FILE,
        );
    }
}
