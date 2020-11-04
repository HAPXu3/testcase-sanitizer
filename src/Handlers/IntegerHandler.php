<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\IntegerError;

class IntegerHandler implements Handler
{
    public function handle($data)
    {
        if (!is_numeric($data)) {
            return new IntegerError;
        }

        return intval($data);
    }
}
