<?php

declare(strict_types=1);

namespace App;

use App\Configuration\Configuration;
use Automattic\IgnoreFile;

final readonly class Action
{
    private Configuration $configuration;

    public function __construct()
    {
        $this->configuration = new Configuration();
    }

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        if (!\extension_loaded('zip')) {
            throw new \Exception('ZIP extension is not loaded');
        }

        $directory = (string) $this->configuration->get('build.directory');

        if (is_dir($directory)) {
            throw new \Exception('Directory "' . $directory . '" is already exists');
        }

        // rights

        mkdir($directory, 0o755, true);

        $ignore = new IgnoreFile();

        $zip = new \ZipArchive();
        if ($zip->open((string) $this->configuration->get('build.file'), \ZipArchive::CREATE) !== true) {
            throw new \Exception('Failed to create zip archive');
        }

        $rootDirectory = $this->configuration->getRootDirectory();

        if (!is_dir($rootDirectory) || !is_readable($rootDirectory) || !is_writable($rootDirectory)) {
            throw new \Exception(
                \sprintf('Directory "%s" is not exists or is not readable or is not writable', $rootDirectory),
            );
        }

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootDirectory),
            \RecursiveIteratorIterator::CHILD_FIRST,
        );

        foreach ($iterator as $path) {
            /**
             * @var \SplFileInfo $path
             */
            if ($path->getBasename() === '.gitignore') {
                $ignore->add(
                    file_get_contents($path->getRealPath()),
                    \dirname($path->getRealPath()) . '/',
                );
            }
        }

        foreach ($iterator as $path) {
            /**
             * @var \SplFileInfo $path
             */
            if (!$path->isFile()) {
                continue;
            }

            if (!$ignore->ignores($path->getPathname())) {
                $zip->addFile($path->getPathname(), str_replace($rootDirectory . \DIRECTORY_SEPARATOR, '', $path->getPathname()));
            }
        }

        $zip->close();

        $GITHUB_OUTPUT = (string) $this->configuration->get('GITHUB_OUTPUT');

        if (!empty($GITHUB_OUTPUT)) {
            $name = 'directory_path';
            $value = (string) $this->configuration->get('build.directory');

            file_put_contents($GITHUB_OUTPUT, "{$name}={$value}\n", FILE_APPEND);

            $name = 'file_path';
            $value = (string) $this->configuration->get('build.file');

            file_put_contents($GITHUB_OUTPUT, "{$name}={$value}\n", FILE_APPEND);
        }
    }
}
