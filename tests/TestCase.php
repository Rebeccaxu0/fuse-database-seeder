<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Assert that the provided relationship of type exists on the provided
     * class.
     *
     * @param  mixed   $class
     * @param  string  $relatedClassName
     * @param  string  $relationship
     * @param  bool    $test_schema
     * @return void
     */
    public function assertRelationship($class, $relatedClassName, $relationship, $test_schema = true): void
    {
        $class = is_string($class) ? $class : $class::class;
        $this->assertTrue(method_exists($class, $relatedClassName), 'Expected class to have method.');
        $args = $this->getRelationshipArguments($class, $relatedClassName, $relationship);

        if ($test_schema) {
          if ($relationship == 'morphTo' && !isset($args[0])) {
            $args[0] = $relatedClassName;
          }
          $this->assertRelationshipSchemaExists($class, $relationship, $args);
        }

        $class = Mockery::mock("{$class}[{$relationship}]")
                        ->shouldIgnoreMissing()
                        ->asUndefined();
        $args[0] = '/' . Str::singular($relatedClassName) . '/i';
        $class->expects()
              ->$relationship(...$args)
              ->andReturn(Mockery::self());

        $class->$relationship(...$args);
    }

    /**
     * Assert that the provided relationship has necessary columns in schema.
     *
     * @param  mixed   $class
     * @param  string  $relationship
     * @param  array   $args
     *   $args[0] is required for all $relationships except `morphTo`
     * @return void
     */
    public function assertRelationshipSchemaExists($class, $relationship, $args): void
    {
        // Test schemas based on relationship type.
        // ~~belongsTo~~
        // ~~belongsToMany~~
        // ~~hasMany~~
        // ~~hasManyThrough~~
        // ~~hasOne~~
        // ~~hasOneThrough~~
        // morphMany
        // morphByMany
        // morphOne
        // morphToMany

        if (in_array($relationship, ['morphedByMany', 'morphToMany'])) {
        }
        if ($relationship == 'morphToMany') {
            [
                $related,
                $name,
                $table,
                $foreignPivotKey,
                $relatedPivotKey,
                $parentKey,
                $relatedKey,
                $inverse,
            ] = array_pad($args, 8, null);

            $morphToMany = (new $class)->morphToMany($related, $name, $table, $foreignPivotKey, $relatedPivotKey, $parentKey, $relatedKey, $inverse);
            $this->assertTrue(Schema::hasColumns($morphToMany->getTable(),
                [
                    $morphToMany->getForeignPivotKeyName(),
                    $morphToMany->getRelatedPivotKeyName(),
                ]));
        }

        if (in_array($relationship, ['morphMany', 'morphOne'])) {
            $class = $args[0];
            $classableFunction = $args[1];
            $args = $this->getRelationshipArguments($class, $classableFunction, 'morphTo');
            $args[0] = $classableFunction;
            $this->assertRelationshipSchemaExists($class, 'morphTo', $args);
            return;
        }

        if ($relationship == 'morphTo') {
            [
              $name,
              $type,
              $id,
              $ownerKey
            ] = array_pad($args, 4, null);

            $morphTo = (new $class)->morphTo($name, $type, $id, $ownerKey);
            $table = $morphTo->getChild()->getTable();
            $columns = [
              $morphTo->getMorphType(),
              $morphTo->getForeignKeyName(),
            ];
            $this->assertTrue(Schema::hasColumns($table, $columns));
        }

        // `hasOneThrough` and `hasManyThrough` schemas are just two `belongsTo`
        // relationships chained.
        if (in_array($relationship, ['hasOneThrough', 'hasManyThrough'])) {
            $relatedClassName = $args[0];
            $throughClassName = $args[1];
            $classForeignKey ??= array_pad($args, 3, null)[2]
                ?? (new $class)->getForeignKey();
            $throughForeignKey ??= array_pad($args, 3, null)[3]
                ?? (new $throughClassName)->getForeignKey();
            $classLocalKey ??= array_pad($args, 3, null)[4]
                ?? (new $class)->getKeyName();
            $throughClassLocalKey ??= array_pad($args, 3, null)[5]
                ?? (new $throughClassName)->getKeyName();
            $this->assertRelationshipSchemaExists(
                (new $relatedClassName),
                'belongsTo',
                [$throughClass, $throughForeignKey, $throughClassLocalKey]
            );
            $this->assertRelationshipSchemaExists((new $throughClassName), 'belongsTo', [$class::class, $classForeignKey, $classLocalKey]);
            return;
        }
        // `hasOne` and `hasMany` are simple inverses of `belongsTo` from a
        // schema perspective. Swap the values and passthrough to `belongsTo`.
        if (in_array($relationship, ['hasOne', 'hasMany'])) {
            $relationship = 'belongTo';
            $relatedClassName = $args[0];
            $childTable = (new $relatedClassName)->getTable();
            $parentTable = (new $class)->getTable();
            $foreignKey ??= array_pad($args, 3, null)[1] ?? (new $relatedClassName)->getForeignKey();
            $localKey ??= array_pad($args, 3, null)[2] ?? (new $relatedClassName)->getKeyName();
            $tmp = $foreignKey;
            $foreignKey = $localKey;
            $localKey = $tmp;
        }

        // Regardless of the inverse relationship it's attached to, `belongsTo`
        // will not have am intermediary table, and only the child has a foreign
        // key (FK). Therefore we only need to assert the child has the FK, and
        // the parent has the local key as defined by the call in the model.
        if ($relationship == 'belongsTo') {
            $relatedClassName = $args[0];
            $childTable ??= (new $class)->getTable();
            $parentTable ??= (new $relatedClassName)->getTable();
            $foreignKey ??= array_pad($args, 3, null)[1] ?? (new $relatedClassName)->getForeignKey();
            $localKey ??= array_pad($args, 3, null)[2] ?? (new $relatedClassName)->getKeyName();
            $this->assertTrue(Schema::hasColumn($childTable, $foreignKey));
            $this->assertTrue(Schema::hasColumn($parentTable, $localKey));
        }

        if ($relationship == 'belongsToMany') {
            [$relatedClassName, $pivotTable, $classForeignKey, $relatedClassForeignKey] = array_pad($args, 4, null);
            $pivotTable ??= (new $class)->joiningTable($relatedClassName);
            $classForeignKey ??= (new $class)->getForeignKey();
            $relatedClassForeignKey ??= (new $relatedClassName)->getForeignKey();
            $this->assertTrue(Schema::hasColumns($pivotTable, [$classForeignKey, $relatedClassForeignKey]));
        }
    }

    /**
     * Get the arguments of the relationship.
     *
     * @param  string  $class
     * @param  string  $relationship
     * @param  string  $type
     * @return array
     */
    public function getRelationshipArguments($class, $relationship, $type): array
    {
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
