<p align="center">
    <img src="https://github.com/davidecaruso/crypt/raw/master/logo.png" alt="Crypt" title="Crypt" />
</p>


<p align="center">
    <a href="https://codecov.io/gh/davidecaruso/crypt"><img src="https://codecov.io/gh/davidecaruso/crypt/branch/master/graph/badge.svg?token=2B9K0OS5SJ"/></a>
    <a href="https://travis-ci.org/davidecaruso/crypt"><img src="https://travis-ci.org/davidecaruso/crypt.svg?branch=master"/></a> 
    <a href="https://packagist.org/packages/davidecaruso/crypt"><img src="https://poser.pugx.org/davidecaruso/crypt/v/stable.svg" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/davidecaruso/crypt"><img src="https://poser.pugx.org/davidecaruso/crypt/license.svg" alt="License"></a>
</p>

> Two-way encryption PHP library.

## Install
```shell
composer require davidecaruso/crypt
```

## How to use
### Idempotent way
By this way, the encryption algorithm will always return the same output when encrypt the same text.
```php
<?php
$passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
$vector = 'f3bb46ceb0e30b88';
$crypt = new Crypt(new Idempotent($passphrase, $vector));

$encrypted = $crypt->encrypt('foobar');
$decrypted = $crypt->decrypt($encrypted);

echo "{$encrypted}\n";
echo "{$decrypted}\n";

// 472c66cde1310e7990ae9afaba8bf44a
// foobar
```

### Non-idempotent way
By this way, the encryption algorithm will always return a new output when encrypt the same text.
```php
<?php
$passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
$crypt = new Crypt(new NonIdempotent($passphrase));

$encrypted = $crypt->encrypt('foobar');
$decrypted = $crypt->decrypt($encrypted);

echo "{$encrypted}\n";
echo "{$decrypted}\n";

// 29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7
// foobar
```

## CLI Commands
### Generate a random 64 bytes secret string
```shell
composer secret:generate
# 015556dd3e30230debd59fa2b7682fadc0795396e3ff1dfece0c6a6784eec834
```

### Encrypt/decrypt by idempotent way
```shell
composer encrypt:idempotent 1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c foobar f3bb46ceb0e30b88
# 472c66cde1310e7990ae9afaba8bf44a
composer decrypt:idempotent 1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c 472c66cde1310e7990ae9afaba8bf44a f3bb46ceb0e30b88
# foobar
```

### Encrypt/decrypt by non-idempotent way
```shell
composer encrypt:non-idempotent 1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c foobar
# 06de08dc3fe774e40d15c0f3111ec6c04f160fd18e98a04ae7ece060b168167e
composer decrypt:non-idempotent 1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c 06de08dc3fe774e40d15c0f3111ec6c04f160fd18e98a04ae7ece060b168167e
# foobar
```

## Author
[Davide Caruso](https://about.me/davidecaruso)

## License
Licensed under [MIT](LICENSE).
