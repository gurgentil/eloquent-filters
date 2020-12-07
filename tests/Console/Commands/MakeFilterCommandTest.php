<?php

namespace Gurgentil\EloquentFilters\Test\Console\Commands;

use Gurgentil\EloquentFilters\Test\TestCase;

class MakeFilterCommandTest extends TestCase
{
    /** @test */
    public function it_exits_with_status_0()
    {
        $this->artisan('make:filter TestFilter')
            ->assertExitCode(0);
    }
}
