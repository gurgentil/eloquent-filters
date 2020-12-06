<?php

namespace Gurgentil\EloquentFilters\Tests;

use Gurgentil\EloquentFilters\ServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }
}
