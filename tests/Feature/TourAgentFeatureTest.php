<?php

namespace Tests\Feature;

use App\TourAgent;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourAgentFeatureTest extends TestCase
{
    
    use RefreshDatabase;

    /** @test */
    public function agents_can_be_listed_via_api()
    {

        // $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        
        factory(TourAgent::class)->create(['name' => 'Foo Bar']);

        $response = $this->get('/api/agents?api_token=' . $user->api_token);

        $data = json_decode($response->content())->data;
        $meta = json_decode($response->content())->meta;

        $this->assertEquals('Foo Bar', $data[0]->name);
        $this->assertObjectHasAttribute('meta',json_decode($response->content()) );


    }

    /** @test */
    public function agent_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $agent = factory(TourAgent::class)->create();

        $this->get('/agents/' . $agent->id)
            ->assertOk()
            ->assertViewHas('agent')
            ->assertSee($agent->name);

    }


    /** @test */
    public function agent_can_be_created_via_api()
    {

        $this->withoutExceptionHandling();

        $data = factory(TourAgent::class)->raw();
        $user = factory(User::class)->create();

        $this->post('/api/agents', array_merge($data, ['api_token' => $user->api_token]))
            ->assertStatus(201);

        $this->assertCount(1, TourAgent::all());



    }


    /** @test */
    public function agent_can_be_updated_via_api()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $agent = factory(TourAgent::class)->create();

        $updates = [
            'name' => 'Foo Bar',
            'address' => 'Foo Bar',
            'email' => 'Foo Bar',
            'phone' => 'Foo Bar'
        ];


        $this->patch('/api/agents/' . $agent->id, array_merge($updates, ['api_token' => $user->api_token ]));

        $agent->refresh();

        $this->assertEquals('Foo Bar', $agent->name);
        $this->assertEquals('Foo Bar', $agent->address);
        $this->assertEquals('Foo Bar', $agent->email);
        $this->assertEquals('Foo Bar', $agent->phone);


    }

    /** @test */
    public function agent_can_be_deleted_via_api()
    {
        $user = factory(User::class)->create();

        $agent = factory(TourAgent::class)->create();

        $this->delete('/api/agents/' . $agent->id . '?api_token=' . $user->api_token)
            ->assertStatus(200);

        $this->assertCount(0, TourAgent::all());


    }


}
