<?php

namespace Gurgentil\EloquentFilters\Test\Dummy;

use Gurgentil\EloquentFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ColorFilter implements Filter
{
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('color', $value);
    }
}
