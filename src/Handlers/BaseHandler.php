<?php

declare(strict_types = 1);

namespace App\Handlers;

abstract class BaseHandler implements Handler
{
    public function __construct(array $config)
    {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
