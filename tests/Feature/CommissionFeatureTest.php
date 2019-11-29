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

class CommissionFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_commission_via_api()
    {
        $this->withoutExceptionHandling();

        factory(TourAgent::class,2)->create();
        factory(CommissionType::class,2)->create();
        factory(TourType::class,3)->create();

        $user = factory(User::class)->create();

        $commission = factory(Commission::class)->raw();

        $this->post('/api/commissions', array_merge($commission, ['api_token' => $user->api_token]))
            ->assertStatus(201);

        
        $this->assertCount(1, Commission::all());
        $this->assertCount(12, TourCommission::all());


    }

    /** @test */
    public function can_delete_commission_via_api()
    {
        $user = factory(User::class)->create();


        $commission = factory(Commission::class)->create();
        factory(TourCommission::class, 5)->create([
            'commission_id' => $commission->id
        ]);

         //Haystack
         $commissionHay = factory(Commission::class)->create();
         factory(TourCommission::class, 3)->create([
             'commission_id' => $commissionHay->id
         ]);

        //There should be 2 commissions and 8 Tourcommissions Before delete
        $this->assertCount(2, Commission::all());
        $this->assertCount(8, TourCommission::all());

        $this->delete('/api/commissions/' . $commission->id . '?api_token=' . $user->api_token )
            ->assertStatus(200);


        $this->assertCount(1, Commission::all());
        $this->assertCount(3, TourCommission::all());


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
