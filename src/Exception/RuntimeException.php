<?php

declare(strict_types=1);

namespace Soap\WsdlReader\Exception;

use Throwable;

abstract class RuntimeException extends \RuntimeException
{
    protected function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
