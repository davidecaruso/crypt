<?php
declare(strict_types=1);

namespace Crypt\Test;

use Crypt\Crypt;
use Crypt\Salt;

/**
 * Class CryptTest
 *
 * @category Class
 * @package  Crypt\Test
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class CryptTest extends TestCase
{
    public function testInstanceWithCustomSecret()
    {
        $message = 'foo bar baz';
        $salt = new Salt('my very secret string');
        $crypt = new Crypt($salt);
        $firstEncrypted = $crypt->encrypt($message);
        $secondEncrypted = $crypt->encrypt($message);
        
        $this->assertNotEquals($firstEncrypted, $secondEncrypted);
        $this->assertSame($message, $crypt->decrypt($firstEncrypted));
        $this->assertSame($message, $crypt->decrypt($secondEncrypted));
    }

    public function testInstanceWithRandomSecret()
    {
        $message = 'foo bar baz';
        $salt = new Salt();
        $crypt = new Crypt($salt);
        $firstEncrypted = $crypt->encrypt($message);
        $secondEncrypted = $crypt->encrypt($message);
        
        $this->assertNotEquals($firstEncrypted, $secondEncrypted);
        $this->assertSame($message, $crypt->decrypt($firstEncrypted));
        $this->assertSame($message, $crypt->decrypt($secondEncrypted));
    }
}
