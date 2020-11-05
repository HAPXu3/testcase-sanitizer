<?php

namespace App\Errors;

abstract class Error
{
    abstract public function getTypeName(): string;

    public function __toString()
    {
        return $this->getMessage();
    }

    protected function getMessage(): string
    {
        return 'Could not convert type to ' . $this->getTypeName();
    }
}
