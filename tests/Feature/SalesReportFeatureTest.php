<?php

namespace Tests\Feature;

use App\Commission;
use App\Deduction;
use App\Product;
use App\SalesCommission;
use App\SalesDeduction;
use App\SalesReport;
use App\SelectedProduct;
use App\TourAgent;
use App\TourGuide;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesReportFeatureTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function can_create_sales_report_and_related_data_via_api()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
    
        $data = $this->createSalesReportData();


        $response = $this->post('/api/sales', array_merge($data, ['api_token' => $user->api_token]));

        // $this->assertCount(0, SalesReport::all());

        $response->assertStatus(201);
        $this->assertContainsOnlyInstancesOf(SalesDeduction::class, SalesReport::first()->salesDeductions); 
        $this->assertContainsOnlyInstancesOf(SelectedProduct::class,SalesReport::first()->selectedProducts);
        $this->assertContainsOnlyInstancesOf(SalesCommission::class,SalesReport::first()->salesCommissions);

    }

    /** @test */
    public function sales_report_fields_are_required()
    {

        $fields = collect(['report_number', 'adult_count', 'children_count', 'tour_agent_id', 
        'tour_guide_id', 'total_sales', 'tour_date', 'total_agent_sales', 'total_commissions', 'total_deductions',
        'gst', 'grand_total_commission']);


        $fields->each(function($field){
            $user = factory(User::class)->create();
            $data = array_merge($this->createSalesReportData(), [$field => '']);

            $this->post('/api/sales', array_merge($data, ['api_token' => $user->api_token]))
                ->assertSessionHasErrors($field);

            $this->assertCount(0, SalesReport::all());

        });


    }

    /** @test */
    public function reports_can_be_listed_via_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
    
        factory(SalesReport::class)->create();

        $response = $this->get('/api/sales/?api_token=' . $user->api_token);

        // $response->assertJsonCount(1);
        $response->assertStatus(200);

    }

    /** @test */
    public function reports_can_be_sorted_via_tour_agent_name()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
    
        factory(SalesReport::class, 5)->create();



        $response = $this->get('/api/sales/?api_token=' . $user->api_token . '&sort=tour_agents&direction=desc');

        // $response->assertJsonCount(3);
        $response->assertStatus(200);

    }

    /** @test */
    public function can_update_sales_report_and_related_data_via_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $report = factory(SalesReport::class)->create();

        $selectedProducts = factory(SelectedProduct::class, 3)->create(['sales_report_id' => $report->id]);
        $salesCommissions = factory(SalesCommission::class, 4)->create(['sales_report_id' => $report->id]);
        $salesDeductions = factory(SalesDeduction::class, 3)->create(['sales_report_id' => $report->id]);

        // dd($salesDeductions[0]->id);

        $addtionalProduct = factory(SelectedProduct::class)->raw([
            'sales_report_id' => $report->id,
            'price' => 100,
            'cost' => 100,
            'quantity' => 100,
            'total' => 100
        ]);

      
        /**
         * Need to simulate the removal and addition of SelectedProducts
         */

        $updatedData = [
            'report_number' =>  $report->report_number,
            'grp_code' => 'Foo Bar',
            'tour_agent_id' => $report->tour_agent_id,
            'tour_guide_id' => $report->tour_guide_id,
            'tour_date' => $this->faker->date('d/m/Y'),
            'adult_count' => 10,
            'children_count' => 10,
            'tc_name' => 'Foo Bar',
            'total_sales' => 100,
            'total_agent_sales' => 100,
            'total_commissions' =>100,
            'total_deductions' => 100,
            'gst' => 100,
            'grand_total_commission' => 100,
            'total' => 100,
            'sales_deductions' => [
                [
                    'id' => $salesDeductions[0]->id,
                    'amount' => 100
                ],
                [
                    'id' => $salesDeductions[1]->id,
                    'amount' => 100
                ],
                [
                    'id' => $salesDeductions[2]->id,
                    'amount' => 100
                ]
            ],
            'sales_commissions' => [
                [
                    'id' => $salesCommissions[0]->id,
                    'amount' => 100
                ],
                [
                    'id' => $salesCommissions[1]->id,
                    'amount' => 100
                ],
                [
                    'id' => $salesCommissions[2]->id,
                    'amount' => 100
                ],
                [
                    'id' => $salesCommissions[3]->id,
                    'amount' => 100
                ],

            ],
            'selected_products' => [
                [
                    'id' => $selectedProducts[0]->id,
                    'product_id' => $selectedProducts[0]->product_id,
                    'price' => 10,
                    'cost' => 10,
                    'quantity' => 10,
                    'total' => 100
                ],
                [
                    'id' => $selectedProducts[1]->id,
                    'product_id' =>$selectedProducts[1]->product_id,
                    'price' => 10,
                    'cost' => 10,
                    'quantity' => 100,
                    'total' => 100
                ],
                [
                    'id' => $selectedProducts[2]->id,
                    'product_id' => $selectedProducts[2]->product_id,
                    'price' => 10,
                    'cost' => 10,
                    'quantity' => 100,
                    'total' => 100
                ],
                $addtionalProduct
            ]
        ];

        // dump($updatedData);

        $this->patch('/api/sales/' . $report->id, array_merge($updatedData, ['api_token' => $user->api_token]));

        $report->refresh();

        $this->assertEquals('Foo Bar', $report->grp_code);
        $this->assertEquals(100, $report->total_sales);

        $report->salesDeductions->each(function($deduction){

            $this->assertEquals(100, $deduction->amount);

        });

        $report->salesCommissions->each(function($commission){

            $this->assertEquals(100, $commission->amount);
            // dump($commission);

        });

        $report->selectedProducts->each(function($selected, $index) use ($selectedProducts){

            $this->assertEquals(100, $selected->total);

            // //Check the new primary key id was created.
            // $this->assertNotEquals($selectedProducts[$index]->product_id, $selected->id);

        });

        $this->assertEquals(4,$report->selectedProducts->count());
    
    }


    /** @test */
    public function sales_report_can_be_delete_via_api()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $report = factory(SalesReport::class)->create();

        factory(SelectedProduct::class, 3)->create(['sales_report_id' => $report->id]);
        factory(SalesCommission::class, 4)->create(['sales_report_id' => $report->id]);
        factory(SalesDeduction::class, 3)->create(['sales_report_id' => $report->id]);



        $this->delete('/api/sales/' . $report->id . '?api_token=' . $user->api_token);

        $this->assertCount(0, SalesReport::all());
        $this->assertCount(0, SalesCommission::all());
        $this->assertCount(0, SalesDeduction::all());
        $this->assertCount(0, SelectedProduct::all());
        
    }


    private function createSalesReportData()
    {

         // Structure the Data as would expect from the Javascript
        // Creating the SalesReport would require to create the related table as well.
        // Frontend will pass all the relevant datas to the controller


        $tourAgent = factory(TourAgent::class)->create();
        $tourGuide = factory(TourGuide::class)->create(['tour_agent_id' => $tourAgent->id]);

        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $product3 = factory(Product::class)->create();

        $commission1 = factory(Commission::class)->create();
        $commission2 = factory(Commission::class)->create();
        $commission3 = factory(Commission::class)->create();
        $commission4 = factory(Commission::class)->create();

        $deduction1 = factory(Deduction::class)->create();
        $deduction2 = factory(Deduction::class)->create();
        $deduction3 = factory(Deduction::class)->create();

        
        return [
            'report_number' => $this->faker->randomNumber,
            'grp_code' => $this->faker->numerify('GRP #######'),
            'adult_count' => $this->faker->numberBetween(5,30),
            'children_count' => $this->faker->numberBetween(0, 10),
            'tour_agent_id' => $tourAgent->id,
            'tour_guide_id' => $tourGuide->id,
            'tc_name' => $this->faker->name,
            'tour_date' => $this->faker->date('d/m/Y'),
            'total_sales' => $this->faker->randomFloat(2),
            'total_agent_sales' => $this->faker->randomFloat(2),
            'total_commissions' => $this->faker->randomFloat(2),
            'total_deductions' => $this->faker->randomFloat(2),
            'gst' => $this->faker->randomFloat(2),
            'grand_total_commission' => $this->faker->randomFloat(2),
            'total' => $this->faker->randomFloat(2),
            'sales_deductions' => [
                [
                    'deduction_id' => $deduction1->id,
                    'amount' => $this->faker->randomFloat(2)
                ],
                [
                    'deduction_id' => $deduction2->id,
                    'amount' => $this->faker->randomFloat(2)
                ],
                [
                    'deduction_id' => $deduction3->id,
                    'amount' => $this->faker->randomFloat(2)
                ]
            ],
            'selected_products' => [
                [
                    'product_id' => $product1->id,
                    'quantity' => $this->faker->randomDigit,
                    'price' => $this->faker->randomFloat(2),
                    'cost' => $this->faker->randomFloat(2),
                    'total' => $this->faker->randomFloat(2)
                ],
                [
                    'product_id' => $product2->id,
                    'quantity' => $this->faker->randomDigit,
                    'price' => $this->faker->randomFloat(2),
                    'cost' => $this->faker->randomFloat(2),
                    'total' => $this->faker->randomFloat(2)
                ],
                [
                    'product_id' => $product3->id,
                    'quantity' => $this->faker->randomDigit,
                    'price' => $this->faker->randomFloat(2),
                    'cost' => $this->faker->randomFloat(2),
                    'total' => $this->faker->randomFloat(2)
                ],
            ],
            'sales_commissions' => [
                [
                    'commission_id' => $commission1->id,
                    'amount' => $this->faker->randomFloat(2)
                ],
                [
                    'commission_id' => $commission2->id,
                    'amount' => $this->faker->randomFloat(2)
                ],
                [
                    'commission_id' => $commission3->id,
                    'amount' => $this->faker->randomFloat(2)
                ],
                [
                    'commission_id' => $commission4->id,
                    'amount' => $this->faker->randomFloat(2)
                ],

            ]
        ];
    }


}
