<?php

declare(strict_types = 1);

namespace App\Errors;

class StructureTypeError extends Error
{
    protected array $fieldsRestrict;

    public function __construct(array $fieldsRestrict)
    {
        $this->fieldsRestrict = $fieldsRestrict;
    }

    public function getTypeName(): string
    {
        $fieldsList = array_map(fn($k, $v) => $k . "({$v})", array_keys($this->fieldsRestrict), $this->fieldsRestrict);
        return 'Structure: ' . implode(', ', $fieldsList);
    }

    protected function getMessage(): string
    {
        return 'The value must be a ' . $this->getTypeName();
    }
}
