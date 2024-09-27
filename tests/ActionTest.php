<?php

declare(strict_types=1);

namespace App;

use App\Configuration\Configuration;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Action::class)]
final class ActionTest extends TestCase
{
    /**
     * @var string
     */
    private const string DEFAULT_ENV_GITHUB_WORKSPACE = '/usr/bin/app';

    private ?Action $action;

    #[\Override]
    protected function setUp(): void
    {
        putenv('GITHUB_WORKSPACE=' . self::DEFAULT_ENV_GITHUB_WORKSPACE);
        putenv('directory=.build');

        $this->action = new Action();

        $this->removeBuildDirectory();
    }

    #[\Override]
    protected function tearDown(): void
    {
        putenv('GITHUB_WORKSPACE=');
        putenv('directory=');

        $this->removeBuildDirectory();

        $this->action = null;
    }

    private function getConfiguration(): Configuration
    {
        if ($this->action instanceof Action) {
            $reflector = new \ReflectionObject($this->action);
            $property = $reflector->getProperty('configuration');
            $property->setAccessible(true);

            $configuration = $property->getValue($this->action);

            if ($configuration instanceof Configuration) {
                return $configuration;
            }
        }

        return new Configuration();
    }

    private function removeBuildDirectory(): void
    {
        $configuration = $this->getConfiguration();
        $directory = (string) $configuration->get('build.directory');

        if (is_dir($directory)) {
            $this->removeDirectory($directory);
        }
    }

    private function removeDirectory(string $dir): void
    {
        $dir = realpath($dir);

        if (is_dir($dir)) {

            $iterator = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir),
                \RecursiveIteratorIterator::CHILD_FIRST,
            );

            foreach ($iterator as $path) {

                if (!$path instanceof \SplFileInfo) {
                    continue;
                }

                if ($path->isDir()) {
                    rmdir((string) $path);
                } else {
                    unlink((string) $path);
                }
            }

            rmdir($dir);
        }
    }

    public function testBuildComposerPackage(): void
    {
        if ($this->action instanceof Action) {
            $this->action->run();
        }

        self::assertFileExists((string) $this->getConfiguration()->get('build.file'));
    }
}
