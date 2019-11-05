<?php

namespace Tests\Feature;

use App\Commission;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommissionFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_commission_via_api()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $commission = factory(Commission::class)->raw();

        $this->post('/api/commissions', array_merge($commission, ['api_token' => $user->api_token]))
            ->assertStatus(201);

        
        $this->assertCount(1, Commission::all());


    }

    /** @test */
    public function can_delete_commission_via_api()
    {
        $user = factory(User::class)->create();


        $commission = factory(Commission::class)->create();

        $this->delete('/api/commissions/' . $commission->id . '?api_token=' . $user->api_token )
            ->assertStatus(200);


        $this->assertCount(0, Commission::all());


    }


    /** @test */
    public function can_update_commission_via_api()
    {
        
        $user = factory(User::class)->create();

        $commission = factory(Commission::class)->create();

        $this->patch('/api/commissions/' . $commission->id, ['name' => 'FooBar', 'api_token' => $user->api_token])
            ->assertStatus(200);

        
        $this->assertEquals('FooBar', Commission::first()->name);

    }

}
