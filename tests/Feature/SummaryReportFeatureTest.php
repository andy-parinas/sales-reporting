<?php

namespace Tests\Feature;

use App\SalesReport;
use App\SummaryReport;
use App\SummaryReportItem;
use App\User;
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
        $user = factory(User::class)->create();
        
        $daily = factory(SalesReport::class, 2)->create();

        $summaryItems = [
           [ 'sales_report_id' => $daily[0]->id],
           [ 'sales_report_id' => $daily[1]->id],
        ];

        $report = factory(SummaryReport::class)->raw();

        // dd($report);

        $data = array_merge($report, ['summary_items' => $summaryItems]);
        // dd($data);

        $this->post('/api/summaries', array_merge($data, ['api_token' => $user->api_token]))
            ->assertStatus(201);

        $this->assertCount(1, SummaryReport::all());
        $this->assertCount(2, SummaryReportItem::all());
    }


    /** @test */
    public function can_list_summary_reports_via_api()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        factory(SummaryReport::class)->create();

        $response = $this->get('/api/summaries?api_token=' . $user->api_token);

        $data = json_decode($response->content())->data;

        $this->assertCount(1, $data);
        
    }
}
