<?php

namespace Tests\Feature;

use App\SalesReport;
use App\SummaryReport;
use App\SummaryReportItem;
use App\TourAgent;
use App\TourGuide;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SummaryReportFeatureTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function can_create_summary_report_via_api_for_tour_agent()
    {
        
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $tourAgent = factory(TourAgent::class)->create();

        
        $daily = factory(SalesReport::class, 2)->create();

        $summaryItems = [
           [ 'sales_report_id' => $daily[0]->id],
           [ 'sales_report_id' => $daily[1]->id],
        ];

        $report = factory(SummaryReport::class)->raw();

        // dd($report);

        $data = array_merge($report, ['summary_items' => $summaryItems]);
      

        $response = $this->post('/api/summaries?reportable=AGENT&id=' . $tourAgent->id , array_merge($data, ['api_token' => $user->api_token]));

        // dd(json_decode($response->content())->reportable_type);
        $result = json_decode($response->content());

        $response->assertStatus(201);
        $this->assertCount(1, SummaryReport::all());
        $this->assertCount(2, SummaryReportItem::all());
        $this->assertEquals("App\TourAgent", $result->reportable_type);
    }

     /** @test */
     public function can_create_summary_report_via_api_for_tour_guide()
     {
         
         $this->withoutExceptionHandling();
         $user = factory(User::class)->create();
 
         $tourGuide = factory(TourGuide::class)->create();
 
         
         $daily = factory(SalesReport::class, 2)->create();
 
         $summaryItems = [
            [ 'sales_report_id' => $daily[0]->id],
            [ 'sales_report_id' => $daily[1]->id],
         ];
 
         $report = factory(SummaryReport::class)->raw();
 
         // dd($report);
 
         $data = array_merge($report, ['summary_items' => $summaryItems]);
       
 
         $response = $this->post('/api/summaries?reportable=GUIDE&id=' . $tourGuide->id , array_merge($data, ['api_token' => $user->api_token]));
 
        //  dd(json_decode($response->content()));
         $result = json_decode($response->content());

         $response->assertStatus(201);
         $this->assertCount(1, SummaryReport::all());
         $this->assertCount(2, SummaryReportItem::all());
         $this->assertEquals("App\TourGuide", $result->reportable_type);
     }


    /** @test */
    public function can_list_summary_reports_via_api()
    {
        // dd("Test");

        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        factory(SummaryReport::class)->create();

        $response = $this->get('/api/summaries?api_token=' . $user->api_token);

        $data = json_decode($response->content())->data;

        $this->assertCount(1, $data);
        
    }

    /** @test */
    public function summary_report_fields_are_required()
    {
        $fields = collect(['report_number', 'title', 'from_date', 'to_date', 
        'adult_count_total', 'children_count_total', 'tc_count', 'sales_total', 'agent_commissions_total', 'gst_total',
        'total', 'balance']);


        $fields->each(function($field){
            $user = factory(User::class)->create();
            $data = array_merge(factory(SummaryReport::class)->raw(), [$field => '']);

            $this->post('/api/summaries', array_merge($data, ['api_token' => $user->api_token]))
                ->assertSessionHasErrors($field);

            $this->assertCount(0, SalesReport::all());

        });

    }

    /** @test */
    public function can_update_summary_report()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();


        $summary = factory(SummaryReport::class)->create();
        factory(SummaryReportItem::class, 5)->create(['summary_report_id' => $summary->id]);



        $updateData = [
            'title' => 'Update',
            'report_number' => 'Update',
            'from_date' => '2019-10-01',
            'to_date' => '2019-10-01',
            'adult_count_total' => 10,
            'children_count_total' => 10,
            'tc_count' => 10,
            'sales_total' => 10,
            'agent_commissions_total' => 10,
            'gst_total' => 10,
            'total' => 10,
            'return' => 10,
            'duvet_deduction' => 10,
            'balance' => 10
        ];

        
        $this->patch('/api/summaries/' . $summary->id, array_merge($updateData, ['api_token' => $user->api_token]))
            ->assertStatus(200);



    }


}
