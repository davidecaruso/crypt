<?php
declare(strict_types=1);

namespace Crypt\Test;

use Crypt\Crypt;
use Crypt\Methods\Exceptions\InvalidVectorLengthException;
use Crypt\Methods\Idempotent;

/**
 * Class IdempotentMethodTest
 *
 * @category Class
 * @package  Crypt\Test
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class IdempotentMethodTest extends TestCase
{
    public function testEncryptShouldReturnSameValue()
    {
        $passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
        $vector = 'f3bb46ceb0e30b88';
        $crypt = new Crypt(new Idempotent($passphrase, $vector));
        
        $this->assertSame('472c66cde1310e7990ae9afaba8bf44a', $crypt->encrypt('foobar'));
        $this->assertSame('472c66cde1310e7990ae9afaba8bf44a', $crypt->encrypt('foobar'));
        $this->assertSame('472c66cde1310e7990ae9afaba8bf44a', $crypt->encrypt('foobar'));
        $this->assertSame('472c66cde1310e7990ae9afaba8bf44a', $crypt->encrypt('foobar'));
        $this->assertSame('472c66cde1310e7990ae9afaba8bf44a', $crypt->encrypt('foobar'));
    }
    
    public function testDecryptShouldReturnInitialValue()
    {
        $passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
        $vector = 'f3bb46ceb0e30b88';
        $crypt = new Crypt(new Idempotent($passphrase, $vector));
        
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
        $this->assertSame('foobar', $crypt->decrypt($crypt->encrypt('foobar')));
    }
    
    public function testShortVectorShouldThrowException()
    {
        $this->expectExceptionObject(new InvalidVectorLengthException(16, 64));
    
        $passphrase = '1765f3de9cb961bfed77a8ec222a3a4948bc269730fb8cd10ef3645b371f589c';
        $vector = 'bd63735f1474675a45e8ec30360991685b31f32405d66f3e1d065a9b5f2faee9';
        $crypt = new Crypt(new Idempotent($passphrase, $vector));
        $crypt->encrypt('foobar');
    }
}
