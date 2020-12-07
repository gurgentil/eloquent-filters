<?php

namespace Gurgentil\EloquentFilters\Test;

use Gurgentil\EloquentFilters\Test\Dummy\Dummy;
use Gurgentil\EloquentFilters\Test\Dummy\DummyFilters;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilterBuilderTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/Dummy/database/migrations');

        Dummy::create(['size' => 'large', 'color' => 'blue']);
        Dummy::create(['size' => 'small', 'color' => 'yellow']);
        Dummy::create(['size' => 'large', 'color' => 'red']);
        Dummy::create(['size' => 'medium', 'color' => 'red']);
        Dummy::create(['size' => 'medium', 'color' => 'yellow']);
    }

    /** @test */
    public function it_applies_a_given_filter_to_the_query()
    {
        $redDummies = (new DummyFilters)->apply(
            (new Dummy)->newModelQuery(),
            ['color' => 'red']
        )->get();

        self::assertCount(2, $redDummies);
        self::assertTrue($redDummies->where('id', 3)->isNotEmpty());
        self::assertTrue($redDummies->where('id', 4)->isNotEmpty());
    }

    /** @test */
    public function it_should_apply_all_filters_in_the_list()
    {
        $redAndLargeDummies = (new DummyFilters)->apply(
            (new Dummy)->newModelQuery(),
            [
                'color' => 'red',
                'size' => 'large',
            ]
        )->get();

        self::assertCount(1, $redAndLargeDummies);
        self::assertTrue($redAndLargeDummies->where('id', 3)->isNotEmpty());
    }
}
