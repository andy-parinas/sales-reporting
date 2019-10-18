<?php

namespace Tests\Unit;

use App\TourAgent;
use App\TourGuide;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourGuideTest extends TestCase
{
    
    use RefreshDatabase;


    // /** @test */
    // public function has_tour_agent()
    // {
    //     $guide = factory(TourGuide::class)->create();

    //     $this->assertInstanceOf(TourAgent::class, $guide->tourAgent);
    // }

}
