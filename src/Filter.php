<?php

namespace Gurgentil\EloquentFilters;

use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public function apply(Builder $builder, $value);
}
