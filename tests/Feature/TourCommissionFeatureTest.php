<?php

namespace Tests\Feature;

use App\TourAgent;
use App\TourCommission;
use App\TourType;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourCommissionFeatureTest extends TestCase
{
    
    use RefreshDatabase;


    /** @test */
    public function can_create_tour_commission()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $tourCommission = factory(TourCommission::class)->raw();

        // dd($tourCommission);

        $this->post('/api/tour-commissions', array_merge($tourCommission, ['api_token' => $user->api_token]))
            ->assertStatus(201);
        

        $this->assertCount(1, TourCommission::all());


    }

    /** @test */
    public function can_update_tour_commission()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $tourCommission = factory(TourCommission::class)->create();

        $this->patch('/api/tour-commissions/' . $tourCommission->id, ['amount' => 100, 'api_token' => $user->api_token] )
            ->assertStatus(200);

        $this->assertEquals(100, TourCommission::first()->amount);


    }

    /** @test */
    public function can_list_tour_commissions_with_query_params()
    {
        
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $tourAgent = factory(TourAgent::class)->create();
        $tourType = factory(TourType::class)->create();


        $tourCommission = factory(TourCommission::class)->create([
            'tour_agent_id' => $tourAgent->id,
            'tour_type_id' => $tourType->id
        ]);

        //Haystack
        factory(TourCommission::class, 5)->create();

        $response = $this->get('/api/tour-commissions?api_token=' . $user->api_token . '&tourAgent=' . $tourAgent->id . '&tourType=' .$tourType->id);
        
        $response->assertJsonCount(1);

    }


}
