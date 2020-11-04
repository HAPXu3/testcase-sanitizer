<?php

declare(strict_types = 1);

namespace App\Errors;

class FloatError extends Error
{
    public function getTypeName(): string
    {
        return 'Float';
    }
}
