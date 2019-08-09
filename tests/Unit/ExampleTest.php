<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Custom\Report;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $report = new Report();
        $pdf = $report->generate();
        $this->assertEquals('cos',get_class($pdf));
        $this->assertIsFloat($report->getSumOfPrices());
    }
}
