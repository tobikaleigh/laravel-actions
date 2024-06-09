<?php

namespace Tobikaleigh\Actions\Exceptions;

use Exception;

class ActionException extends Exception
{
    public static function make(string $message): self
    {
        return new static($message);
    }

    public static function notFound(string $message): NotFoundException
    {
        return new NotFoundException($message);
    }

    public static function invalid(string $message): InvalidException
    {
        return new InvalidException($message);
    }
}
