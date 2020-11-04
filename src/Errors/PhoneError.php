<?php

declare(strict_types = 1);

namespace App\Errors;

class PhoneError extends Error
{
    public function getTypeName(): string
    {
        return 'Phone';
    }
}
