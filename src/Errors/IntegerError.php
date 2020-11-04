<?php

declare(strict_types = 1);

namespace App\Errors;

class IntegerError extends Error
{
    public function getTypeName(): string
    {
        return 'Integer';
    }
}
