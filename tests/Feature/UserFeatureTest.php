<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserFeatureTest extends TestCase
{

    use RefreshDatabase;
    
    /** @test */
    public function can_list_users_via_api()
    {
    
        $user = factory(User::class)->create();

        $response = $this->get('/api/users?api_token=' . $user->api_token);

        $response->assertJsonFragment([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);

    }
}
