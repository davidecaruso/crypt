<?php
declare(strict_types=1);

namespace Crypt\Methods\Exceptions;

use Throwable;

/**
 * Class InvalidVectorLengthException
 *
 * @category Class
 * @package  Crypt\Methods\Exceptions
 * @author   Davide Caruso <davide.caruso93@gmail.com>
 */
class InvalidVectorLengthException extends \Exception
{
    public function __construct(int $expected, int $given, $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf('Invalid IV length: passed is %d bytes long, expected %d bytes long', $given, $expected),
            $code,
            $previous
        );
    }
}
