<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\ArrayError;
use App\Errors\ArrayTypeError;

class ArrayHandler extends BaseHandler
{
    protected string $typeRestrict;

    public function handle($data)
    {
        if (!is_array($data) || (array_keys($data) !== range(0, count($data) - 1))) {
            return new ArrayError;
        }

        $types = array_unique(array_map('gettype', $data));

        if (
            !empty($this->typeRestrict)
            && ((count($types) !== 1) || (array_pop($types) !== $this->typeRestrict))
        ) {
            return new ArrayTypeError($this->typeRestrict);
        }

        return $data;
    }
}
