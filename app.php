<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

// const ROOT = __DIR__;
define('ROOT', $_ENV['GITHUB_WORKSPACE']);

try {
    $core = new App\Action();
    $core->run();
} catch (Exception $e) {
    // echo $e->getMessage();
}
