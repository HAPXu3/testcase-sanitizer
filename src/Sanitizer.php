<?php

declare(strict_types = 1);

namespace App;

use App\Errors\Error;

class Sanitizer
{
    protected HandlerFactory $factory;

    protected array $errors = [];

    public function __construct(HandlerFactory $factory = null)
    {
        $this->factory = $factory ?? new HandlerFactory;
    }

    public function sanitize(array $data, array $rules): object
    {
        if (count($data) !== count($rules)) {
            throw new \InvalidArgumentException('Count of $data must be equal count of $rules');
        }

        $result = new \stdClass();
        $dataValues = array_values($data);
        $dataKeys = array_keys($data);

        foreach ($rules as $n => $rule) {
            $handler = $this->factory->createHandler($rule);
            $handledData = $handler->handle($dataValues[$n]);

            if ($handledData instanceof Error) {
                $this->errors[$dataKeys[$n]] = strval($handledData);
                continue;
            }

            $result->{$dataKeys[$n]} = $handledData;
        }

        return $result;
    }

    public function addRuleHandler(string $name, string $handlerClass): self
    {
        $this->factory->extend($name, $handlerClass);

        return $this;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
