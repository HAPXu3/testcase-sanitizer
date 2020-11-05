<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\IntegerError;

class IntegerHandler extends BaseHandler
{
    public function handle($data)
    {
        if (!is_numeric($data)) {
            return new IntegerError;
        }

        return intval($data);
    }
}
