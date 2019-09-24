<?php

namespace Tests\Feature;

use App\TourAgent;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TourAgentFeatureTest extends TestCase
{
    
    use RefreshDatabase;

    /** @test */
    public function agents_can_be_listed()
    {

        // $this->withoutExceptionHandling();
        
        factory(TourAgent::class)->create();

        $this->get('/agents')
            ->assertOk()
            ->assertViewHas('agents');


    }

    /** @test */
    public function agent_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        $agent = factory(TourAgent::class)->create();

        $this->get('/agents/' . $agent->id)
            ->assertOk()
            ->assertViewHas('agent')
            ->assertSee($agent->name);

    }


    /** @test */
    public function agent_can_be_created()
    {

        $this->withoutExceptionHandling();

        $data = factory(TourAgent::class)->raw();

        $this->post('/agents', $data)
            ->assertRedirect('/agents/' . TourAgent::first()->id);

        $this->assertCount(1, TourAgent::all());



    }


    /** @test */
    public function agent_can_be_updated()
    {
        $agent = factory(TourAgent::class)->create();

        $updates = [
            'name' => 'Foo Bar',
            'address' => 'Foo Bar',
            'email' => 'Foo Bar',
            'phone' => 'Foo Bar'
        ];


        $this->patch('/agents/' . $agent->id, $updates)
            ->assertRedirect('/agents/' . $agent->id);

        $agent->refresh();

        $this->assertEquals('Foo Bar', $agent->name);
        $this->assertEquals('Foo Bar', $agent->address);
        $this->assertEquals('Foo Bar', $agent->email);
        $this->assertEquals('Foo Bar', $agent->phone);


    }

    /** @test */
    public function agent_can_be_delete()
    {
        $agent = factory(TourAgent::class)->create();

        $this->delete('/agents/' . $agent->id)
            ->assertRedirect('/agents');

        $this->assertCount(0, TourAgent::all());


    }


}
