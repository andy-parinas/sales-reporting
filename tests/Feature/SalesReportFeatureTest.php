<?php

namespace Tests\Feature;

use App\Commission;
use App\Deduction;
use App\Product;
use App\SalesCommission;
use App\SalesReport;
use App\SelectedProduct;
use App\TourAgent;
use App\TourGuide;
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

        // $this->withoutExceptionHandling();

       
    
        $data = $this->createSalesReportData();


        $response = $this->post('/api/sales', $data);

        // $this->assertCount(0, SalesReport::all());

        $response->assertStatus(200);
        $this->assertInstanceOf(Deduction::class, SalesReport::first()->deduction); // Check if Deduction was created
        $this->assertContainsOnlyInstancesOf(SelectedProduct::class,SalesReport::first()->selectedProducts);
        $this->assertContainsOnlyInstancesOf(SalesCommission::class,SalesReport::first()->salesCommissions);

    }

    /** @test */
    public function sales_report_fields_are_required()
    {
        $fields = collect(['report_number','grp_code', 'adult_count', 'children_count', 'tour_agent_id', 
        'tour_guide_id', 'tc_name', 'total_sales', 'total_agent_sales', 'total_commission', 
        'gst', 'grand_total_commission','guide_incentive', 'delivery', 'service','total', ]);


        $fields->each(function($field){
            $data = array_merge($this->createSalesReportData(), [$field => '']);

            $this->post('/api/sales', $data)
                ->assertSessionHasErrors($field);

            $this->assertCount(0, SalesReport::all());

        });



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

        
        return [
            'report_number' => $this->faker->randomNumber,
            'grp_code' => $this->faker->numerify('GRP #######'),
            'adult_count' => $this->faker->numberBetween(5,30),
            'children_count' => $this->faker->numberBetween(0, 10),
            'tour_agent_id' => $tourAgent->id,
            'tour_guide_id' => $tourGuide->id,
            'tc_name' => $this->faker->name,
            'total_sales' => $this->faker->randomFloat(2),
            'total_agent_sales' => $this->faker->randomFloat(2),
            'total_commission' => $this->faker->randomFloat(2),
            'gst' => $this->faker->randomFloat(2),
            'grand_total_commission' => $this->faker->randomFloat(2),
            'guide_incentive' => $this->faker->randomFloat(2),
            'delivery' => $this->faker->randomFloat(2),
            'service' => $this->faker->randomFloat(2),
            'total' => $this->faker->randomFloat(2),
            'selected_products' => [
                [
                    'product_id' => $product1->id,
                    'quantity' => $this->faker->randomDigit,
                    'total' => $this->faker->randomFloat(2)
                ],
                [
                    'product_id' => $product2->id,
                    'quantity' => $this->faker->randomDigit,
                    'total' => $this->faker->randomFloat(2)
                ],
                [
                    'product_id' => $product3->id,
                    'quantity' => $this->faker->randomDigit,
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
