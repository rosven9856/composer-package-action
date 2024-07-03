<?php

declare(strict_types=1);

namespace App;

use App\Configuration\Configuration;

class Action
{
    protected Configuration $configuration;

    /**
     *
     */
    public function __construct()
    {
        $this->configuration = new Configuration();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        if (!extension_loaded('zip')) {
            throw new \Exception('ZIP extension is not loaded');
        }

        $directory = (string) $this->configuration->get('build.directory');

        if (is_dir($directory)) {
            throw new \Exception('Directory "' . $directory . '" is already exists');
        }

        // rights

        mkdir($directory, 0755, true);

        $zip = new \ZipArchive();
        if ($zip->open((string) $this->configuration->get('build.file'), \ZipArchive::CREATE) !== true) {
            throw new \Exception('Failed to create zip archive');
        }

        $rootDirectory = $this->configuration->getRootDirectory();

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootDirectory),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $path) {

            /**
             * @var \SplFileInfo $path
             */

            // exclude files described in .gitignore

            if ($path->isFile()) {
                $zip->addFile($path->getPathname(), str_replace($rootDirectory . DIRECTORY_SEPARATOR, '', $path->getPathname()));
            }
        }

        $zip->close();
    }
}
