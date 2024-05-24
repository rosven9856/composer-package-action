<?php

declare(strict_types=1);

namespace App\Configuration;

final class Configuration
{
    protected readonly array $options;

    /**
     *
     */
    public function __construct ()
    {
        $directory = !empty(getenv('BUILD_DIRECTORY')) ? getenv('BUILD_DIRECTORY') : '.build';
        $fileName  = !empty(getenv('BUILD_FILE_NAME')) ? getenv('BUILD_FILE_NAME') : 'package.zip';

        $this->options = [
            'build' => [
                'directory' => ROOT . '/' . $directory,
                'file' => ROOT . '/' . $directory . '/' . $fileName,
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
            if (!empty($target[$key])) {
                $target = $target[$key];
            } else {
                return null;
            }
        }

        if (empty($target)) {
            return null;
        }

        return $target;
    }
}
