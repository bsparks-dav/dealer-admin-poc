<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CollectionEloquentBuilder extends Builder
{
    protected $model;

    public function __construct($query, $model = null)
    {
        parent::__construct($query);
        $this->model = $model;
    }

    // Override the get method to return our collection data
    public function get($columns = ['*'])
    {
        $collection = CollectionEloquentModel::getCollection();
        return $collection;
    }

    // Override the count method
    public function count($columns = '*')
    {
        return CollectionEloquentModel::getCollection()->count();
    }

    // Updated paginate method with correct signature
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null, $total = null)
    {
        $page = $page ?: \Illuminate\Pagination\Paginator::resolveCurrentPage($pageName);
        $perPage = $perPage ?: $this->model->getPerPage();

        $collection = CollectionEloquentModel::getCollection();

        // Apply any filters
        $collection = $this->applyFiltersToCollection($collection);

        // Use provided total if available, otherwise use collection count
        $total = $total ?: $collection->count();

        // Create a paginator
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($page, $perPage),
            $total,
            $perPage,
            $page,
            [
                'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]
        );

        return $paginator;
    }

    // Custom method to apply filters from the query
    protected function applyFiltersToCollection(Collection $collection)
    {
        // At this point, we would apply any where clauses or sorting
        // This is a simple implementation that would need to be extended
        // for complex queries
        return $collection;
    }

    // Override toBase to return our collection data
    public function toBase()
    {
        return CollectionEloquentModel::getCollection();
    }

    // Add this method to intercept property access
    public function __get($key)
    {
        // Special case for 'orders'
        if ($key === 'orders') {
            return collect();
        }

        return parent::__get($key);
    }

    // Add additional methods to handle search and filter if needed
}
