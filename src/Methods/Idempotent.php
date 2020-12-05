<?php
declare(strict_types=1);

namespace Crypt\Methods;

use Crypt\Methods\Exceptions\InvalidVectorLengthException;

/**
 * Class Idempotent
 *
 * @category Class
 * @package  Crypt\Methods
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class Idempotent extends Method
{
    /**
     * @var string
     */
    protected $vector;
    
    /**
     * Idempotent constructor.
     *
     * @param string $passphrase
     * @param string $vector
     * @param string $cipher
     *
     * @throws \Crypt\Methods\Exceptions\InvalidVectorLengthException
     */
    public function __construct(string $passphrase, string $vector, string $cipher = 'AES-256-CBC')
    {
        if (strlen($vector) !== openssl_cipher_iv_length($cipher)) {
            throw new InvalidVectorLengthException(openssl_cipher_iv_length($cipher), strlen($vector));
        }
        parent::__construct($passphrase, $cipher);
        $this->vector = $vector;
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    public function encrypt(string $text): string
    {
        return bin2hex(openssl_encrypt($text, $this->cipher, $this->passphrase, OPENSSL_RAW_DATA, $this->vector));
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    public function decrypt(string $text): string
    {
        return openssl_decrypt(hex2bin($text), $this->cipher, $this->passphrase, OPENSSL_RAW_DATA, $this->vector);
    }
}
