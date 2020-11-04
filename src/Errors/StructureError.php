<?php

declare(strict_types = 1);

namespace App\Errors;

class StructureError extends Error
{
    public function getTypeName(): string
    {
        return 'Structure';
    }
}
