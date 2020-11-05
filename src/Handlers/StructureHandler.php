<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\StructureError;

class StructureHandler extends BaseHandler
{
    public function handle($data)
    {
        if (!is_array($data) && (array_keys($data) !== range(0, count($data) - 1))) {
            return new StructureError;
        }

        return $data;
    }
}
