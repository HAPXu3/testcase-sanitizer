<?php

declare(strict_types = 1);

namespace App\Errors;

class ArrayError extends Error
{
    public function getTypeName(): string
    {
        return 'Array';
    }
}
