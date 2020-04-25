<?php
declare(strict_types=1);

namespace Crypt;

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
     * @var \Crypt\Salt
     */
    protected $salt;
    
    /**
     * @var string
     */
    private const METHOD = 'AES-256-CTR';
    
    /**
     * Crypt constructor.
     *
     * @param \Crypt\Salt $salt
     */
    public function __construct(Salt $salt)
    {
        $this->salt = $salt;
    }
    
    /**
     * @param string $message
     *
     * @return string
     */
    public function encrypt(string $message): string
    {
        $string = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::METHOD));
        $encrypted = openssl_encrypt(
            $message,
            self::METHOD,
            $this->salt->digested(),
            OPENSSL_RAW_DATA,
            $string
        );
        
        return bin2hex($string . $encrypted);
    }
    
    /**
     * @param string $message
     *
     * @return string
     */
    public function decrypt(string $message): string
    {
        $message = hex2bin($message);
        
        $length = openssl_cipher_iv_length(self::METHOD);
        $string = mb_substr($message, 0, $length, '8bit');
        $data = mb_substr($message, $length, null, '8bit');
        
        return openssl_decrypt(
            $data,
            self::METHOD,
            $this->salt->digested(),
            OPENSSL_RAW_DATA,
            $string
        );
    }
}
