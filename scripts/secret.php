<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/colors.php';

print sprintf(
    "\n%s%s\n\n",
    $lightgreen,
    \Crypt\Salt::generate()
);
