<?php
declare(strict_types=1);

namespace Crypt\Methods;

/**
 * Class NonIdempotent
 *
 * @category Class
 * @package  Crypt\Methods
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class NonIdempotent extends Method
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function encrypt(string $text): string
    {
        $vector = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encrypted = openssl_encrypt(
            $text,
            $this->cipher,
            $this->digest($this->passphrase),
            OPENSSL_RAW_DATA,
            $vector
        );
        
        return bin2hex($vector . $encrypted);
    }
    
    /**
     * @param string $text
     *
     * @return string
     */
    public function decrypt(string $text): string
    {
        $message = hex2bin($text);
        
        $length = openssl_cipher_iv_length($this->cipher);
        $vector = mb_substr($message, 0, $length, '8bit');
        $data = mb_substr($message, $length, null, '8bit');
        
        return openssl_decrypt(
            $data,
            $this->cipher,
            $this->digest($this->passphrase),
            OPENSSL_RAW_DATA,
            $vector
        );
    }
    
    /**
     * @param string $passphrase
     *
     * @return string
     */
    private function digest(string $passphrase): string
    {
        return openssl_digest($passphrase, 'SHA256', true);
    }
}
