<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/colors.php';

$help = 'Usage: decrypt [idempotent|non-idempotent] [passphrase] [text] [idempotent?iv]';
if ($argc < 3 || !($passphrase = ($argv[2] ?? null)) || !($text = ($argv[3] ?? null)) || (
        ($method = $argv[1]) === 'idempotent' && !($iv = ($argv[4] ?? null)))) {
    die($help);
}

print sprintf(
    "\n%s%s\n\n",
    $lightgreen,
    (new Crypt\Crypt(
        $method === 'idempotent' ?
            new \Crypt\Methods\Idempotent($passphrase, $iv) :
            new \Crypt\Methods\NonIdempotent($passphrase)
    ))->decrypt($text)
);
