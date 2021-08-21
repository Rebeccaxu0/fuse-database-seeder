<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that the provided object has the provided method.
     *
     * @param  mixed   $class
     * @param  mixed   $method
     * @param  string  $message
     * @return void
     */
    public function assertRespondsTo($class, $method, $message = 'Expected class to have method.')
    {
        $this->assertTrue(method_exists($class, $method), $message);
    }

    /**
     * Assert that the provided relationship of type exists on the provided
     * class.
     *
     * @param  mixed   $class
     * @param  string  $relationship
     * @param  string  $type
     * @return void
     */
    public function assertRelationship($class, $relationship, $type)
    {
        $class = is_string($class) ? $class : $class::class;
        $this->assertRespondsTo($class, $relationship);
        $args = $this->getRelationshipArguments($class, $relationship, $type);
        $class = Mockery::mock("{$class}[{$type}]")
                        ->shouldIgnoreMissing()
                        ->asUndefined();
        $args[0] = '/' . Str::singular($relationship) . '/i';
        $class->expects()
              ->$type(...$args)
              ->andReturn(Mockery::self());

        $class->$type(...$args);
    }

    /**
     * Get the arguments of the relationship.
     *
     * @param  string  $class
     * @param  string  $relationship
     * @param  string  $type
     * @return array
     */
    public function getRelationshipArguments($class, $relationship, $type) {
        $args = [];

        $closure = function() use (&$args) {
            $args = func_get_args();
            return Mockery::self();
        };

        $mock = Mockery::mock("{$class}[{$type}]");
        $mock->shouldIgnoreMissing()
            ->asUndefined()
            ->shouldReceive($type)
            ->once()
            ->andReturnUsing($closure);

        $mock->$relationship();

        return $args;
    }
}
