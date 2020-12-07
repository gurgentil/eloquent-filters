<?php

namespace Gurgentil\EloquentFilters;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Apply filters.
     *
     * @param Builder $builder
     * @param array|null $filters
     * @return Builder
     */
    public function scopeFilter(Builder $builder, $filters)
    {
        $modelClass = class_basename($this);
        $builderClass = 'App\\Filters\\' . $modelClass . 'Filters';

        return (new $builderClass)->apply($builder, $filters);
    }
}
