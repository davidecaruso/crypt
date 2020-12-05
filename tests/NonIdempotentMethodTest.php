<?php
declare(strict_types=1);

namespace Crypt\Test;

use Crypt\Crypt;
use Crypt\Methods\Exceptions\InvalidVectorLengthException;
use Crypt\Methods\NonIdempotent;

/**
 * Class NonIdempotentMethodTest
 *
 * @category Class
 * @package  Crypt\Test
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class NonIdempotentMethodTest extends TestCase
{
    public function testEncryptShouldReturnSameValue()
    {
        $passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
        $crypt = new Crypt(new NonIdempotent($passphrase));
        $this->assertNotEquals(
            '29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7',
            $crypt->encrypt('foobar')
        );
        $this->assertNotEquals(
            '29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7',
            $crypt->encrypt('foobar')
        );
        $this->assertNotEquals(
            '29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7',
            $crypt->encrypt('foobar')
        );
        $this->assertNotEquals(
            '29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7',
            $crypt->encrypt('foobar')
        );
        $this->assertNotEquals(
            '29162d5b677312fa8b0039dfd72150e01510a1a1cd628671ea12da178672dcd7',
            $crypt->encrypt('foobar')
        );
    }
    
    public function testDecryptShouldReturnInitialValue()
    {
        $passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
        $crypt = new Crypt(new NonIdempotent($passphrase));
    
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
    }
}
