<?php

namespace Tests\Unit;

use App\TourAgent;
use App\TourGuide;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourAgentTest extends TestCase
{
   
    use RefreshDatabase;

    /** @test */
    public function has_tour_guides()
    {
        $agent = factory(TourAgent::class)->create();

        $guide = factory(TourGuide::class)->create(['tour_agent_id' => $agent->id]);

        $this->assertInstanceOf(Collection::class, $agent->tourGuides);


    }

}
