<?php

namespace Gurgentil\EloquentFilters\Test\Dummy;

use Gurgentil\EloquentFilters\Filter;
use Illuminate\Database\Eloquent\Builder;

class SizeFilter implements Filter
{
    public function apply(Builder $builder, $value)
    {
        return $builder->where('size', $value);
    }
}
