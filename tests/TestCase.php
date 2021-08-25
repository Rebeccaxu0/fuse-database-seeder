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
        $tests = [];

        if (in_array($relationship, ['morphedByMany', 'morphToMany'])) {
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
            $tables[$morphToMany->getTable()] = [
                $morphToMany->getForeignPivotKeyName(),
                $morphToMany->getRelatedPivotKeyName(),
            ];
        }

        // `morphOne` and `morphMany` are simple inverses of `morphTo` from a
        // schema perspective. Swap the values and passthrough to `morphTo`.
        if (in_array($relationship, ['morphMany', 'morphOne'])) {
            $class = $args[0];
            $classableFunction = $args[1];
            $args = $this->getRelationshipArguments($class, $classableFunction, 'morphTo');
            $args[0] = $classableFunction;
            $this->assertRelationshipSchemaExists($class, 'morphTo', $args);
            return;
        }

        if ($relationship == 'morphTo') {
            [$name, $type, $id, $ownerKey] = array_pad($args, 4, null);

            $morphTo = (new $class)->morphTo($name, $type, $id, $ownerKey);
            foreach ($morphTo->morphMap() as $morphClass) {
              if ($morphClass != $class) {
                $morph = new $morphClass;
                $tables[$morph->getTable()] = [$morph->getKeyName()];
              }
            }
            $tables[$morphTo->getChild()->getTable()] = [
              $morphTo->getMorphType(),
              $morphTo->getForeignKeyName(),
            ];
        }

        // `hasOneThrough` and `hasManyThrough` schemas are just two `belongsTo`
        // relationships chained.
        if (in_array($relationship, ['hasOneThrough', 'hasManyThrough'])) {
            [
                $relatedClassName,
                $throughClassName,
                $classForeignKey,
                $throughForeignKey,
                $classLocalKey,
                $throughClassLocalKey,
            ] = array_pad($args, 6, null);
            $classForeignKey ??= (new $class)->getForeignKey();
            $throughForeignKey ??= (new $throughClassName)->getForeignKey();
            $classLocalKey ??= (new $class)->getKeyName();
            $throughClassLocalKey ??= (new $throughClassName)->getKeyName();

            $this->assertRelationshipSchemaExists(
                (new $relatedClassName),
                'belongsTo',
                [$throughClass, $throughForeignKey, $throughClassLocalKey]
            );
            $this->assertRelationshipSchemaExists(
                (new $throughClassName),
                'belongsTo',
                [$class::class, $classForeignKey, $classLocalKey]
            );
            return;
        }

        // `hasOne` and `hasMany` are simple inverses of `belongsTo` from a
        // schema perspective. Swap the values and passthrough to `belongsTo`.
        if (in_array($relationship, ['hasOne', 'hasMany'])) {
            [
              $related,
              $foreignKey,
              $localKey,
            ] = array_pad($args, 3, null);
            $foreignKey ??= (new $class)->getForeignKey();
            $localKey ??= (new $class)->getKeyName();
            $newArgs = [$class, $foreignKey, $localKey];
            $this->assertRelationshipSchemaExists($args[0], 'belongsTo', $newArgs);
            return;
        }

        // Regardless of the inverse relationship it's attached to, `belongsTo`
        // will not have am intermediary table, and only the child has a foreign
        // key (FK). Therefore we only need to assert the child has the FK, and
        // the parent has the local key as defined by the call in the model.
        if ($relationship == 'belongsTo') {
            [$related, $foreignKey, $ownerKey, $relation] = array_pad($args, 4, null);
            $foreignKey ??= (new $related)->getForeignKey();
            $belongsTo = (new $class)->belongsTo($related, $foreignKey, $ownerKey, $relation);
            $childTable = $belongsTo->getChild()->getTable();
            $ownerTable = $belongsTo->getRelated()->getTable();
            $ownerKey = $belongsTo->getOwnerKeyName();

            $tests[$childTable] = [$foreignKey];
            $tests[$ownerTable] = [$ownerKey];
        }

        if ($relationship == 'belongsToMany') {
            [$relatedClassName, $pivotTable, $classForeignKey, $relatedClassForeignKey] = array_pad($args, 4, null);
            $pivotTable ??= (new $class)->joiningTable($relatedClassName);
            $classForeignKey ??= (new $class)->getForeignKey();
            $relatedClassForeignKey ??= (new $relatedClassName)->getForeignKey();
            $tests[$pivotTable] = [$classForeignKey, $relatedClassForeignKey];
            $tables[(new $class)->getTable()] = [(new $class)->getKeyName()];
            $tables[(new $relatedClassName)->getTable()] = [(new $relatedClassName)->getKeyName()];
        }

        foreach ($tests as $table => $columns) {
          $this->assertTrue(Schema::hasColumns($table, $columns));
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
