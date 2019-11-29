<?php

namespace Tests\Feature;

use App\Commission;
use App\CommissionType;
use App\TourAgent;
use App\TourCommission;
use App\TourType;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourTypeFeatureTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function can_create_tour_type_via_api()
    {
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        factory(TourAgent::class,2)->create();
        factory(CommissionType::class,2)->create();
        factory(Commission::class,3)->create();

        $tourTypeData = factory(TourType::class)->raw();


        $response = $this->post('/api/tour-types', array_merge($tourTypeData, ['api_token' =>$user->api_token]) );

        $response->assertStatus(201);

        $this->assertCount(12, TourCommission::all());


    }

    /** @test */
    public function can_update_tour_type_via_api()
    {
        $user = factory(User::class)->create();

        $tourType = factory(TourType::class)->create();


        $this->patch('api/tour-types/' . $tourType->id, ['name' => 'FooBar', 'api_token' => $user->api_token])
            ->assertStatus(200);

        $this->assertEquals('FooBar', TourType::first()->name);

    }


    /** @test */
    public function can_delete_tour_type_via_api()
    {
        $user = factory(User::class)->create();

        //Needdle
        $tourType = factory(TourType::class)->create();
        factory(TourCommission::class, 5)->create([
            'tour_type_id' => $tourType->id
        ]);

        //Haystack
        $tourTypeHay = factory(TourType::class)->create();
        factory(TourCommission::class, 3)->create([
            'tour_type_id' => $tourTypeHay->id
        ]);
        
        //There should be 2 TourType and 8 Tourcommission Before delete
        $this->assertCount(2, TourType::all());
        $this->assertCount(8, TourCommission::all());

        $this->delete('/api/tour-types/' . $tourType->id . '?api_token=' . $user->api_token )
            ->assertStatus(200);
        
        //There should be 1 TourType and 3 Tourcommission After delete
        $this->assertCount(1, TourType::all());
        $this->assertCount(3, TourCommission::all());
    }
}
