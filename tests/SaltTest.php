<?php
declare(strict_types=1);

namespace Crypt\Test;

use Crypt\Salt;

/**
 * Class SaltTest
 *
 * @category Class
 * @package  Crypt\Test
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class SaltTest extends \Crypt\Test\TestCase
{
    public function testGenerateFunctionShouldReturnARandomString()
    {
        $firstSecret = Salt::generate();
        $secondSecret = Salt::generate();
        
        $this->assertNotEmpty($firstSecret);
        $this->assertNotEmpty($secondSecret);
        $this->assertIsString($firstSecret);
        $this->assertIsString($secondSecret);
        $this->assertNotEquals($firstSecret, $secondSecret);
    }

    public function testInstanceWithoutParameterShouldReturnAFilledSalt()
    {
        $salt = new Salt();
        
        $this->assertNotEmpty($salt->secret());
        $this->assertNotEmpty($salt->digested());
        $this->assertNotEquals($salt->secret(), $salt->digested());
    }

    public function testTwoInstancesShouldBeDifferent()
    {
        $firstSalt = new Salt();
        $secondSalt = new Salt();
        
        $this->assertNotEmpty($firstSalt->secret());
        $this->assertNotEmpty($firstSalt->digested());
        $this->assertNotEquals($firstSalt->secret(), $firstSalt->digested());
        
        $this->assertNotEmpty($secondSalt->secret());
        $this->assertNotEmpty($secondSalt->digested());
        $this->assertNotEquals($secondSalt->secret(), $secondSalt->digested());
        
        $this->assertNotEquals($firstSalt->secret(), $secondSalt->secret());
        $this->assertNotEquals($firstSalt->digested(), $secondSalt->digested());
    }

    public function testInstanceWithArgument()
    {
        $salt = new Salt('my very secret string');
    
        $this->assertNotEmpty($salt->secret());
        $this->assertNotEmpty($salt->digested());
        $this->assertNotEquals($salt->secret(), $salt->digested());
    }

    public function testInstancesWithSameArgumentShouldBeEqual()
    {
        $firstSalt = new Salt('my very secret string');
        $secondSalt = new Salt('my very secret string');
    
        $this->assertNotEmpty($firstSalt->secret());
        $this->assertNotEmpty($firstSalt->digested());
        $this->assertNotEquals($firstSalt->secret(), $firstSalt->digested());
    
        $this->assertNotEmpty($secondSalt->secret());
        $this->assertNotEmpty($secondSalt->digested());
        $this->assertNotEquals($secondSalt->secret(), $secondSalt->digested());
    
        $this->assertEquals($firstSalt->secret(), $secondSalt->secret());
        $this->assertEquals($firstSalt->digested(), $secondSalt->digested());
    }
}
