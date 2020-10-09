<?php

namespace App\Core\Exceptions;

/**
 * Class InvalidDataSharedClassException
 * @package App\Core\Exceptions
 */
class InvalidDataSharableClassException extends \Exception
{
    private const MESSAGE = "Data sharing class should implement DataSharableInterface contract";

    /**
     * InvalidDataSharedClassException constructor.
     *
     * @param string $message
     */
    public function __construct($message = "")
    {
        parent::__construct($message ?: self::MESSAGE);
    }
}
