<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

try {
    $core = new App\Action();
    $core->run();
} catch (Exception $e) {
    // echo $e->getMessage();
}
