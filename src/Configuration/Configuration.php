<?php

declare(strict_types=1);

namespace App\Configuration;

final readonly class Configuration
{
    private array $options;

    /**
     * @use
     */
    public function __construct()
    {
        $GITHUB_WORKSPACE = (string) getenv('GITHUB_WORKSPACE');
        $GITHUB_OUTPUT = (string) getenv('GITHUB_OUTPUT');
        $dirName = (string) getenv('BUILD_DIRECTORY_NAME');
        $fileName  = (string) getenv('BUILD_FILE_NAME');

        $GITHUB_WORKSPACE = !empty($GITHUB_WORKSPACE) ? $GITHUB_WORKSPACE : realpath(__DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..');
        $GITHUB_OUTPUT = !empty($GITHUB_OUTPUT) ? $GITHUB_OUTPUT : $GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . 'var' . \DIRECTORY_SEPARATOR . 'outputcmd.txt';
        $dirName = !empty($dirName) ? $dirName : '.build';
        $fileName  = !empty($fileName) ? $fileName : 'package.zip';

        $this->options = [
            'GITHUB_WORKSPACE' => $GITHUB_WORKSPACE,
            'GITHUB_OUTPUT' => $GITHUB_OUTPUT,
            'build' => [
                'directory' => $GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . $dirName,
                'file' => $GITHUB_WORKSPACE . \DIRECTORY_SEPARATOR . $dirName . \DIRECTORY_SEPARATOR . $fileName,
            ],
        ];
    }

    public function get(string $option): mixed
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

    public function getRootDirectory(): string
    {
        return (string) $this->get('GITHUB_WORKSPACE');
    }
}
