<?php

namespace Gurgentil\EloquentFilters;

use Illuminate\Database\Eloquent\Builder;

abstract class FiltersBuilder implements Filter
{
    /**
     * Filter maps.
     *
     * Ex.: ['name' => NameFilter::class]
     *
     * @var array
     */
    protected $availableFilters = [];

    /**
     * Apply all filters to the model.
     *
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function apply(Builder $builder, $filters)
    {
        if (is_null($filters)) {
            return $builder;
        }

        foreach ($filters as $filter => $value) {
            if ($this->filterExists($filter)) {
                $builder = $this->applyFilterQuery($builder, $filter, $value);
            }
        }

        return $builder;
    }

    /**
     * Determine whether filter is available.
     *
     * @param $filter
     * @return bool
     */
    protected function filterExists($filter)
    {
        return array_key_exists($filter, $this->availableFilters);
    }

    /**
     * Create filter instance and apply it to the query.
     *
     * @param Builder $builder
     * @param $filter
     * @param $value
     * @return Builder
     */
    protected function applyFilterQuery(Builder $builder, $filter, $value)
    {
        $filterClass = $this->availableFilters[$filter];

        return (new $filterClass)->apply($builder, $value);
    }
}
