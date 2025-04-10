<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;

class CollectionQueryBuilder extends Builder
{
    // Override count to avoid database queries
    public function count($columns = '*')
    {
        return CollectionEloquentModel::getCollection()->count();
    }

    // Override toSql to return a dummy SQL statement
    public function toSql()
    {
        return 'SELECT * FROM collection_data /* This is a virtual collection, no actual SQL */';
    }

    // Override get to return collection data
    public function get($columns = ['*'])
    {
        return CollectionEloquentModel::getCollection();
    }

    // Override aggregate to avoid SQL queries
    public function aggregate($function, $columns = ['*'])
    {
        $collection = CollectionEloquentModel::getCollection();

        // Handle common aggregate functions
        switch (strtolower($function)) {
            case 'count':
                return $collection->count();
            case 'min':
                return $collection->min($columns[0] ?? 'id');
            case 'max':
                return $collection->max($columns[0] ?? 'id');
            case 'avg':
                return $collection->avg($columns[0] ?? 'id');
            case 'sum':
                return $collection->sum($columns[0] ?? 'id');
            default:
                return 0;
        }
    }

    // Override runSelect to avoid database queries
    public function runSelect()
    {
        return [];
    }

    public function orderBy($column, $direction = 'asc')
    {
        // Just return $this without doing anything
        return $this;
    }

    public function with($relations)
    {
        // Just return $this without doing anything
        return $this;
    }

    public function has($relation)
    {
        // Just return $this without doing anything
        return $this;
    }


    // Add more overrides as needed
}
