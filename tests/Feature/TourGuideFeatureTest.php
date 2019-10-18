<?php

namespace Tests\Feature;

use App\TourGuide;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourGuideFeatureTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function can_add_tour_guide_via_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $guide = factory(TourGuide::class)->raw();


        $this->post('/api/guides', array_merge($guide, ['api_token' => $user->api_token]))
            ->assertStatus(201);
        
        $this->assertCount(1, TourGuide::all());


    }

}
