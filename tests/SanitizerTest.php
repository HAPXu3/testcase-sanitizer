<?php

declare(strict_types = 1);

namespace Tests;

use App\Sanitizer;
use PHPUnit\Framework\TestCase;

class SanitizerTest extends TestCase
{
    public function testSanitizeOne()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}';
        $json = json_decode($jsonString, true);
        $rules = ['integer', 'string', 'phone'];

        $result = $sanitizer->sanitize($json, $rules);

        $this->assertObjectHasAttribute('foo', $result);
        $this->assertIsInt($result->foo);
        $this->assertSame(123, $result->foo);

        $this->assertObjectHasAttribute('bar', $result);
        $this->assertIsString($result->bar);
        $this->assertSame('asd', $result->bar);

        $this->assertObjectHasAttribute('baz', $result);
        $this->assertIsString($result->baz);
        $this->assertSame('79502885623', $result->baz);

        $hasErrors = $sanitizer->hasErrors();
        $errors = $sanitizer->getErrors();

        $this->assertFalse($hasErrors);
        $this->assertEmpty($errors);
    }

    public function testSanitizeTwo()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"string": "123абв"}';
        $json = json_decode($jsonString, true);
        $rules = ['integer'];

        $result = $sanitizer->sanitize($json, $rules);
        $errors = $sanitizer->getErrors();

        $this->assertEmpty((array)$result);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('string', $errors);
        $this->assertSame('Could not convert type to Integer', $errors['string']);
    }

    public function testSanitizeThree()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"phone": "260557"}';
        $json = json_decode($jsonString, true);
        $rules = ['phone'];

        $result = $sanitizer->sanitize($json, $rules);
        $errors = $sanitizer->getErrors();

        $this->assertEmpty((array)$result);
        $this->assertCount(1, $errors);
        $this->assertArrayHasKey('phone', $errors);
        $this->assertSame('Could not convert type to Phone', $errors['phone']);
    }

    public function testAddRuleHandler()
    {
        $sanitizer = new Sanitizer();
        $sanitizer->addRuleHandler('null', NullHandler::class);

        $jsonString = '{"foo": null}';
        $json = json_decode($jsonString, true);
        $rules = ['null'];

        $result = $sanitizer->sanitize($json, $rules);
        $errors = $sanitizer->getErrors();
        $hasErrors = $sanitizer->hasErrors();

        $this->assertObjectHasAttribute('foo', $result);
        $this->assertNull($result->foo);
        $this->assertFalse($hasErrors);
        $this->assertEmpty($errors);

        $jsonString = '{"foo": "null"}';
        $json = json_decode($jsonString, true);
        $rules = ['null'];

        $result = $sanitizer->sanitize($json, $rules);
        $errors = $sanitizer->getErrors();
        $hasErrors = $sanitizer->hasErrors();

        $this->assertEmpty((array)$result);
        $this->assertTrue($hasErrors);
        $this->assertCount(1, $errors);
        $this->assertSame('Could not convert type to Null', $errors['foo']);
    }

    public function testArraySanitize()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"array": ["123", "asd", "8 (950) 288-56-23"]}';
        $json = json_decode($jsonString, true);
        $rules = ['array'];

        $result = $sanitizer->sanitize($json, $rules);
        $hasErrors = $sanitizer->hasErrors();
        $errors = $sanitizer->getErrors();

        $this->assertObjectHasAttribute('array', $result);
        $this->assertIsArray($result->array);
        $this->assertFalse($hasErrors);
        $this->assertEmpty($errors);
    }

    public function testFloatSanitize()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"float": "123.13"}';
        $json = json_decode($jsonString, true);
        $rules = ['float'];

        $result = $sanitizer->sanitize($json, $rules);
        $hasErrors = $sanitizer->hasErrors();
        $errors = $sanitizer->getErrors();

        $this->assertObjectHasAttribute('float', $result);
        $this->assertIsFloat($result->float);
        $this->assertFalse($hasErrors);
        $this->assertEmpty($errors);
    }

    public function testStructureSanitize()
    {
        $sanitizer = new Sanitizer();

        $jsonString = '{"structure": {"foo": "123", "bar": "asd", "baz": "8 (950) 288-56-23"}}';
        $json = json_decode($jsonString, true);
        $rules = ['structure'];

        $result = $sanitizer->sanitize($json, $rules);
        $hasErrors = $sanitizer->hasErrors();
        $errors = $sanitizer->getErrors();

        $this->assertObjectHasAttribute('structure', $result);
        $this->assertIsArray($result->structure);
        $this->assertArrayHasKey('foo', $result->structure);
        $this->assertSame('123', $result->structure['foo']);
        $this->assertArrayHasKey('bar', $result->structure);
        $this->assertSame('asd', $result->structure['bar']);
        $this->assertArrayHasKey('baz', $result->structure);
        $this->assertSame('8 (950) 288-56-23', $result->structure['baz']);
        $this->assertFalse($hasErrors);
        $this->assertEmpty($errors);
    }
}
