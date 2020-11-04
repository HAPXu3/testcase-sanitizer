<?php

declare(strict_types = 1);

namespace App;

use App\Handlers\{ArrayHandler, FloatHandler, Handler, IntegerHandler, PhoneHandler, StringHandler, StructureHandler};

class HandlerFactory
{
    protected array $extends = [];

    protected const DEFAULT_HANDLERS = [
        'array' => ArrayHandler::class,
        'float' => FloatHandler::class,
        'integer' => IntegerHandler::class,
        'phone' => PhoneHandler::class,
        'string' => StringHandler::class,
        'structure' => StructureHandler::class,
    ];

    public function createHandler(string $type): Handler
    {
        $handlers = $this->getRegisteredHandlers();

        if (!in_array($type, array_keys($handlers))) {
            throw new \InvalidArgumentException('$type is invalid');
        }

        return new $handlers[$type];
    }

    public function getRegisteredHandlers(): array
    {
        return array_merge(self::DEFAULT_HANDLERS, $this->extends);
    }

    public function extend(string $name, string $class): void
    {
        if (!is_subclass_of($class, Handler::class)) {
            throw new \InvalidArgumentException('$class must be a child of Handler interface');
        }

        $this->extends[$name] = $class;
    }
}
