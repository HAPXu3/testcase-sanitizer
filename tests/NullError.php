<?php

declare(strict_types = 1);

namespace Tests;

use App\Errors\Error;

class NullError extends Error
{
    public function getTypeName(): string
    {
        return 'Null';
    }
}
