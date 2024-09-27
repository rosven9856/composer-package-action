<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

try {
    $core = new App\Action();
    $core->run();
} catch (Exception) {
    // echo 'Error: ' . $e->getMessage() . "\n" . 'Trace: ' . $e->getTraceAsString();
}
