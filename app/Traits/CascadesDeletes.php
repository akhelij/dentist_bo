<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation;

trait CascadesDeletes
{
    protected static function bootCascadesDeletes()
    {
        static::deleting(function($model) {
            // Wrap all of the cascading deletes inside of a transaction to make this an
            // all or nothing operation. Any exceptions thrown inside the transaction
            // need to bubble up to make sure all transactions will be rolled back.
            $model->getConnectionResolver()->transaction(function () use ($model) {

                // check if model has cascades deletes
                $relations = $model->getCascadeDeletesRelations();

                if ($invalidRelations = $model->getInvalidCascadeDeletesRelations($relations)) {
                    throw new LogicException(sprintf('[%s]: invalid relationship(s) for cascading deletes. Relationship method(s) [%s] must return an object of type Illuminate\Database\Eloquent\Relations\Relation.', static::class, implode(', ', $invalidRelations)));
                }

                $deleteMethod = $model->isCascadeDeletesForceDeleting() ? 'forceDelete' : 'delete';
                // foreach relation
                foreach ($relations as $relationName => $relation) {
                    $expected = 0;
                    $deleted = 0;

                    $query = $model->getCascadeDeletesRelationQuery($relationName);

                    if ($relation instanceof BelongsToMany) {
                        // Process the many-to-many relationships on the model.
                        // These relationships should not delete the related
                        // record, but should just detach from each other.
                        $expected = $query->count();
                        $deleted = $query->detach();
                    } elseif ($relation instanceof HasOneOrMany) {
                        // Process the one-to-one and one-to-many relationships
                        // on the model. These relationships should actually
                        // delete the related records from the database.
                        $children = $query->get();

                        // To protect against potential relationship defaults,
                        // filter out any children that may not actually be
                        // Model instances, or that don't actually exist.
                        $children = $children->filter(function ($child) {
                            return $child instanceof Model && $child->exists;
                        })->all();

                        $expected = count($children);

                        foreach ($children as $child) {
                            // Delete the record using the proper method.
                            $child->$deleteMethod();

                            // forceDelete doesn't return anything until Laravel 5.2. Check
                            // exists property to determine if the delete was successful
                            // since that is the last thing set before delete returns.
                            //
                            // Starting in Laravel 5.5, soft deleted records do not set the
                            // exists property to false, so if exists is still true, we
                            // need to check if the deleted at column is set.
                            $deleted += (!$child->exists || (method_exists($child, 'getDeletedAtColumn') && !empty($child->{$child->getDeletedAtColumn()})));
                        }
                    } else {
                        // Not all relationship types make sense for cascading. BelongsTo relationship for example
                        throw new LogicException(sprintf('[%s]: error occurred deleting [%s]. Relation type [%s] not handled.', static::class, $relationName, get_class($relation)));
                    }

                    if ($deleted < $expected) {
                        throw new LogicException(sprintf('[%s]: error occurred deleting [%s]. Only deleted [%d] out of [%d] records.', static::class, $relationName, $deleted, $expected));
                    }
                }

            });

        });
    }

    /**
     * Get the value of the cascadeDeletes attribute, if it exists.
     *
     * @return mixed
     */
    public function getCascadeDeletes()
    {
        return property_exists($this, 'cascadeDeletes') ? $this->cascadeDeletes : [];
    }

    /**
     * Get the relationship query to use for the specified relation.
     *
     * @param  string  $relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\Relation
     */
    public function getCascadeDeletesRelationQuery($relation)
    {
        // If this is a force delete and the related model is using soft deletes,
        // we need to use the withTrashed() scope on the relationship query to
        // ensure all related records, plus soft deleted, are force deleted.

        $query = $this->$relation();
        return  $this->isCascadeDeletesForceDeleting() ? $query->withTrashed() : $query;
    }

    /**
     * Get an array of the cascading relation names mapped to their relation types.
     *
     * @return array
     */
    public function getCascadeDeletesRelations()
    {
        $names = $this->getCascadeDeletesRelationNames();

        return array_combine($names, array_map(function ($name) {
            $relation = method_exists($this, $name) ? $this->$name() : null;

            return $relation instanceof Relation ? $relation : null;
        }, $names));
    }

    /**
     * Get an array of cascading relation names.
     *
     * @return array
     */
    public function getCascadeDeletesRelationNames()
    {
        $deletes = $this->getCascadeDeletes();

        return array_filter(is_array($deletes) ? $deletes : [$deletes]);
    }

    /**
     * Get an array of the invalid cascading relation names.
     *
     * @param  array|null  $relations
     *
     * @return array
     */
    public function getInvalidCascadeDeletesRelations(array $relations = null)
    {
        return array_keys($relations ?: $this->getCascadeDeletesRelations(), null);
    }


    /**
     * Check if this cascading delete is a force delete.
     *
     * @return boolean
     */
    public function isCascadeDeletesForceDeleting()
    {
        return property_exists($this, 'forceDeleting') && $this->forceDeleting;
    }

}
