<?php

declare(strict_types = 1);

namespace App\Handlers;

use App\Errors\StructureError;
use App\Errors\StructureTypeError;

class StructureHandler extends BaseHandler
{
    protected array $fieldsRestrict = [];

    public function handle($data)
    {
        if (!is_array($data) || (array_keys($data) === range(0, count($data) - 1))) {
            return new StructureError;
        }

        $types = array_map('gettype', $data);

        if (
            !empty($this->fieldsRestrict)
            && (
                !empty(array_diff_assoc($this->fieldsRestrict, $types))
                || count($types) !== count($this->fieldsRestrict)
            )
        ) {
            return new StructureTypeError($this->fieldsRestrict);
        }

        return $data;
    }
}
