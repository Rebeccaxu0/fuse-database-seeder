<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that the provided class belongs to the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertBelongsTo($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'belongsTo');
    }

    /**
     * Assert that the provided class belongs to many of the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertBelongsToMany($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'belongsToMany');
    }

    /**
     * Assert that the provided class has one of the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertHasOne($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'hasOne');
    }

    /**
     * Assert that the provided class has one of the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertHasMany($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'hasMany');
    }

    /**
     * Assert that the provided class morphs to the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertMorphMany($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'morphMany');
    }

    /**
     * Assert that the provided class morphs to the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertMorphTo($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'morphTo');
    }

    /**
     * Assert that the provided class morphs to the provided relation.
     *
     * @param  mixed   $class
     * @param  string  $relation
     * @return void
     */
    public function assertMorphToMany($class, $relation)
    {
        $this->assertRelationship($class, $relation, 'morphToMany');
    }

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
        $mocked = Mockery::mock("{$class}[{$type}]")
            ->shouldIgnoreMissing()
            ->asUndefined();

        $args = [];

        $mocked->shouldReceive($type)
            ->once()
            ->andReturnUsing(function() use (&$args)
            {
                $args = func_get_args();
                return Mockery::self();
            });

        $mocked->$relationship();

        return $args;
    }
}
