#!/usr/bin/env php
<?php declare(strict_types=1);

require __DIR__.'/src/bootstrap.php';

array_shift($argv);

App\Console\Command::factory(array_shift($argv), ...$argv);

exit;