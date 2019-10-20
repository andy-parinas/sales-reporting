<?php

namespace Tests\Feature;

use App\SalesReport;
use App\SummaryReport;
use App\SummaryReportItem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummaryReportFeatureTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function can_create_summary_report_via_api()
    {
        $this->withoutExceptionHandling();
        
        $daily = factory(SalesReport::class, 2)->create();

        $summaryItems = [
           [ 'sales_report_id' => $daily[0]->id],
           [ 'sales_report_id' => $daily[1]->id],
        ];

        $report = factory(SummaryReport::class)->raw();

        $data = array_merge($report, ['summary_items' => $summaryItems]);
        // dd($data);

        $this->post('/api/summary', $data)
            ->assertStatus(201);

        $this->assertCount(1, SummaryReport::all());
        $this->assertCount(2, SummaryReportItem::all());
    }


}
