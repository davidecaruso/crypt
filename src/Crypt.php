<?php
declare(strict_types=1);

namespace Crypt;

use Crypt\Methods\Method;

/**
 * Class Crypt
 *
 * @category Class
 * @package  Crypt
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class Crypt
{
    /**
     * @var \Crypt\Methods\Method
     */
    protected $method;
    /**
     * @var string
     */
    protected $cipher;
    
    /**
     * Crypt constructor.
     *
     * @param \Crypt\Methods\Method $method
     */
    public function __construct(Method $method)
    {
        $this->method = $method;
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    public function encrypt(string $text): string
    {
        return $this->method->encrypt($text);
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    public function decrypt(string $text): string
    {
        return $this->method->decrypt($text);
    }
}
