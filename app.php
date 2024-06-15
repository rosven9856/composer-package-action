<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

const ROOT = __DIR__;

try {
    $core = new App\Action();
    $core->run();
} catch (Exception $e) {
    // echo $e->getMessage();
}
