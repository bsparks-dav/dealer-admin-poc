<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CollectionEloquentModel extends Model
{
    // Prevent Laravel from trying to find a real table
    protected $table = 'non_existent_table'
    ;

    // Allow all attributes to be mass assignable
    protected $guarded = [];

    // Disable timestamps
    public $timestamps = false;

    // Store our data collection
    protected static $collection = null;

    // Factory method to create from collection
    public static function fromCollection(Collection $collection)
    {
        static::$collection = $collection;

        return new static;
    }

    // Override query builder creation to return our custom builder
    public function newEloquentBuilder($query)
    {
        return new CollectionEloquentBuilder($query, $this);
    }

    // Override the database query method
    public function newQuery()
    {
        return $this->newModelQuery();
    }

    // Override the base query method
    public function newModelQuery()
    {
        $builder = $this->newEloquentBuilder(
            $this->newBaseQueryBuilder()
        );

        return $builder->setModel($this);
    }

    // Create a query builder that doesn't try to connect to the database
    protected function newBaseQueryBuilder()
    {
        $connection = $this->getConnection();

        return new CollectionQueryBuilder(
            $connection,
            $connection->getQueryGrammar(),
            $connection->getPostProcessor()
        );
    }

    // Accessor to get the collection
    public static function getCollection()
    {
        return static::$collection ?? collect();
    }

    public static function fromArray(array $data): self
    {
        $model = new self;
        $model->forceFill($data);
        $model->exists = true;

        return $model;
    }
}
