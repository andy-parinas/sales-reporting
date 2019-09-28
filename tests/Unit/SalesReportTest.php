<?php

namespace Tests\Unit;

use App\Deduction;
use App\SalesCommission;
use App\SalesReport;
use App\SelectedProduct;
use App\TourAgent;
use App\TourGuide;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesReportTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function report_has_tour_agent()
    {
        $sales = factory(SalesReport::class)->create();

        $this->assertInstanceOf(TourAgent::class, $sales->tourAgent);

    }


      /** @test */
      public function report_has_tour_guide()
      {
          $sales = factory(SalesReport::class)->create();
  
          $this->assertInstanceOf(TourGuide::class, $sales->tourGuide);
  
      }

      /** @test */
      public function report_have_selected_products()
      {
          $sales = factory(SalesReport::class)->create();
        
          factory(SelectedProduct::class)->create(['sales_report_id' => $sales->id]);

          $this->assertContainsOnlyInstancesOf(SelectedProduct::class, $sales->selectedProducts);

      }

      /** @test */
      public function report_has_deduction()
      {
          $sales = factory(SalesReport::class)->create();

          factory(Deduction::class)->create(['sales_report_id' => $sales->id]);

          $this->assertInstanceOf(Deduction::class, $sales->deduction);
      }
  
      /** @test */
      public function report_have_sales_commissions()
      {
          $sales = factory(SalesReport::class)->create();

          factory(SalesCommission::class)->create(['sales_report_id' => $sales->id]);

          $this->assertContainsOnlyInstancesOf(SalesCommission::class, $sales->salesCommissions);
      }
}
