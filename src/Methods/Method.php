<?php
declare(strict_types=1);

namespace Crypt\Methods;

/**
 * Class Method
 *
 * @category Class
 * @package  Crypt\Methods
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
abstract class Method
{
    /**
     * @var string
     */
    protected $cipher;
    /**
     * @var string
     */
    protected $passphrase;
    
    /**
     * Method constructor.
     *
     * @param string $passphrase
     * @param string $cipher
     */
    public function __construct(string $passphrase, string $cipher = 'AES-256-CBC')
    {
        $this->passphrase = $passphrase;
        $this->cipher = $cipher;
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    abstract public function encrypt(string $text): string;
    
    /**
     * @param string $text
     *
     * @return string
     */
    abstract public function decrypt(string $text): string;
}
