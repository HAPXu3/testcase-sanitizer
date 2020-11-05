<?php

declare(strict_types = 1);

namespace App\Errors;

class ArrayTypeError extends Error
{
    protected string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getTypeName(): string
    {
        return 'Array of ' . $this->type;
    }
}
