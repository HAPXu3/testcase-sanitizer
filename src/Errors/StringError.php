<?php

declare(strict_types = 1);

namespace App\Errors;

class StringError extends Error
{
    public function getTypeName(): string
    {
        return 'String';
    }
}
