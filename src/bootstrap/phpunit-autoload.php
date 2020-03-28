<?php

use Beanz\Testing\TestBootstrap;

require __DIR__ . '/autoload.php';

(new TestBootstrap)->bootstrap();

if (($argv[1] ?? '') === 'print') {
    echo getenv('TEST_HASH');
}
