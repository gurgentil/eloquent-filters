<?php

namespace Gurgentil\EloquentFilters\Test\Dummy;

use Gurgentil\EloquentFilters\FilterBuilder;

class DummyFilters extends FilterBuilder
{
    protected $availableFilters = [
        'color' => ColorFilter::class,
        'size' => SizeFilter::class,
    ];
}
