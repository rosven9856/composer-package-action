<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

try {
    $action = new App\Action();
    $action->run();
} catch (Exception) {
    // echo 'Error: ' . $e->getMessage() . "\n" . 'Trace: ' . $e->getTraceAsString();
}
