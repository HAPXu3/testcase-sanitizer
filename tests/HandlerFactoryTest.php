<?php

declare(strict_types = 1);

namespace Tests;

use App\HandlerFactory;
use PHPUnit\Framework\TestCase;

class HandlerFactoryTest extends TestCase
{
    public function testExtend()
    {
        $factory = new HandlerFactory([]);
        $factory->extend('null', NullHandler::class);

        $handler = $factory->createHandler('null');
        $this->assertInstanceOf(NullHandler::class, $handler);
    }
}
