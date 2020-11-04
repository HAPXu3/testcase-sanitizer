<?php

declare(strict_types = 1);

namespace Tests;

use App\Handlers\Handler;

class NullHandler implements Handler
{
    public function handle($data)
    {
        if (!is_null($data)) {
            return new NullError;
        }

        return $data;
    }
}
