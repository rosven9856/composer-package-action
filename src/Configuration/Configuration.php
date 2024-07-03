<?php

declare(strict_types=1);

namespace App\Configuration;

final class Configuration
{
    protected readonly array $options;

    /**
     * @use
     */
    public function __construct ()
    {
        $root = (string) getenv('GITHUB_WORKSPACE');
        $dirName = (string) getenv('BUILD_DIRECTORY_NAME');
        $fileName  = (string) getenv('BUILD_FILE_NAME');

        $root = !empty($root) ? $root : realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..');
        $dirName = !empty($dirName) ? $dirName : '.build';
        $fileName  = !empty($fileName) ? $fileName : 'package.zip';

        $this->options = [
            'root' => $root,
            'build' => [
                'directory' => $root . DIRECTORY_SEPARATOR . $dirName,
                'file' => $root . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $fileName,
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

    /**
     * @return string
     */
    public function getRootDirectory (): string
    {
        return (string) $this->get('root');
    }
}
