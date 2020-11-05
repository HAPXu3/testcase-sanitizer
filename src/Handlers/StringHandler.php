<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\StringError;

class StringHandler extends BaseHandler
{
    public function handle($data)
    {
        if (!is_string($data)) {
            return new StringError;
        }

        return strval($data);
    }
}
