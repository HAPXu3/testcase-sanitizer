<?php

declare(strict_types = 1);

namespace App;

use App\Handlers\Handler;

class HandlerBuilder
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function build(string $type, string $class): Handler
    {
        return new $class((array)$this->config[$type] ?? []);
    }
}
