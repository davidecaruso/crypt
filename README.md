<p align="center">
    <img src="https://github.com/davidecaruso/crypt/raw/master/logo.png" alt="Crypt" title="Crypt" />
</p>

> **Encrypt** a string generating every time a random one that can always be **decrypted** by returning the original using a **secret** key.

## Install
```shell script
composer require davidecaruso/crypt
```

## Simple usage
```php
<?php
$salt = new \Crypt\Salt('don\'t tell anyone');
$crypt = new \Crypt\Crypt($salt);

$encrypted = $crypt->encrypt('hey! don\'t let me be clear');
$decrypted = $crypt->decrypt($encrypted);

echo "{$encrypted}\n";
echo "{$decrypted}\n";
```
Output:
```text
c41da6c42e58ff58bfe7a2bf7271f89ace07f07b9c9ee71ced9efbd5d6539f966dab2f167bb22c463b37
hey! don't let me be clear
```

## Generate a random secret key 
### CLI
```shell script
composer run-script secret
```
Output:
```text
266eeed875cf3b015a2c62d2c52f1ffe3febe2c8082f9804597ab68b1a10c40d
```

### Programmatically
```php
<?php
$salt = new \Crypt\Salt();
echo $salt->secret();
```
Output:
```text
d84a5a3882dce7377185be55446a1ef73b128c63a014b754e46b702984f9a287
```

## Author
[Davide Caruso](https://about.me/davidecaruso)

## License
Licensed under [MIT](LICENSE).
