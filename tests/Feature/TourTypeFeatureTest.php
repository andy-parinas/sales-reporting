<?php

namespace Tests\Feature;

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

        $tourTypeData = factory(TourType::class)->raw();


        $response = $this->post('/api/tour-types', array_merge($tourTypeData, ['api_token' =>$user->api_token]) );

        $response->assertStatus(201);


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

        $tourType = factory(TourType::class)->create();


        $this->delete('/api/tour-types/' . $tourType->id . '?api_token=' . $user->api_token )
            ->assertStatus(200);

        $this->assertCount(0, TourType::all());
    }
}
