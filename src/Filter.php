<?php

namespace Gurgentil\EloquentFilters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    /**
     * Apply filter.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public function apply(Builder $builder, $value);
}
