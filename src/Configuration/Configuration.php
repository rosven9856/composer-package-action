<?php

declare(strict_types=1);

namespace App\Configuration;

use const ROOT;

final class Configuration
{
    protected readonly array $options;

    /**
     * @use
     */
    public function __construct ()
    {
        $dirName = (string) getenv('BUILD_DIRECTORY_NAME');
        $fileName  = (string) getenv('BUILD_FILE_NAME');

        $dirName = !empty($dirName) ? $dirName : '.build';
        $fileName  = !empty($fileName) ? $fileName : 'package.zip';

        if (!defined('ROOT')) {
            define('ROOT', '');
        }

        $this->options = [
            'build' => [
                'directory' => ROOT . '/' . $dirName,
                'file' => ROOT . '/' . $dirName . '/' . $fileName,
            ]
        ];
    }

    /**
     * @param string $option
     * @return mixed
     */
    public function get (string $option): mixed
    {
        $keys = explode('.', $option);
        $target = $this->options;

        foreach ($keys as $key) {
            if (isset($target[$key])) {
                $target = $target[$key];
            } else {
                return null;
            }
        }

        if (!isset($target)) {
            return null;
        }

        return $target;
    }

    public function getRootDirectory (): string
    {
        return realpath($this->get('build.directory') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    }
}
