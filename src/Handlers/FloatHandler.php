<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\FloatError;

class FloatHandler implements Handler
{
    public function handle($data)
    {
        if (!is_numeric($data)) {
            return new FloatError;
        }

        return floatval($data);
    }
}
