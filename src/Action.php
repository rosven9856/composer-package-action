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
     */
    public function run()
    {
        if (!extension_loaded('zip')) {
            // throw
        }

        $directory = $this->configuration->get('build.directory');

        if (is_dir($directory)) {
            // throw
        }

        // rights

        mkdir($directory, 0755, true);

        $zip = new \ZipArchive();
        if (!$zip->open($this->configuration->get('build.file'), \ZipArchive::CREATE)) {
            // throw
        }

        $rootDirectory = $this->configuration->getRootDirectory();

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($rootDirectory),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($iterator as $path) {

            // exclude files described in .gitignore

            if ($path->isFile()) {
                $zip->addFile($path->getPathname(), str_replace($rootDirectory . DIRECTORY_SEPARATOR, '', $path->getPathname()));
            }
        }

        $zip->close();
    }
}
