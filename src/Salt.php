<?php
declare(strict_types=1);

namespace Crypt;

/**
 * Class Salt
 *
 * @category Class
 * @package  Crypt
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class Salt
{
    /**
     * @var string
     */
    protected $secret;
    
    /**
     * @var string
     */
    private const METHOD = 'SHA256';
    
    /**
     * @var string|false
     */
    protected $digested;
    
    /**
     * Salt constructor.
     *
     * @param string|null $secret
     */
    public function __construct(string $secret = null)
    {
        $this->secret = $secret ?? self::generate();
        $this->digested = openssl_digest($this->secret, self::METHOD, true);
    }
    
    /**
     * @return string
     */
    public function secret(): string
    {
        return $this->secret;
    }
    
    /**
     * @return false|string
     */
    public function digested()
    {
        return $this->digested;
    }
    
    /**
     * @return string
     */
    public static function generate(): string
    {
        return hash(self::METHOD, (string) rand());
    }
}
