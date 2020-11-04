<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\ArrayError;

class ArrayHandler implements Handler
{
    public function handle($data)
    {
        if (!is_array($data) && (array_keys($data) === range(0, count($data) - 1))) {
            return new ArrayError;
        }

        return $data;
    }
}
