<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Nette\Utils\Strings;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_load_api_page()
    {
        $response = $this->getJson('api/users/');
        $response ->assertStatus(200);
    }

    /** @test */
    public function can_fetch_single_user()
    {
        $user = User::factory()->create();
        $response = $this->getJson('/api/users/'.$user->getRouteKey());
        $response->assertExactJson([
            'data'=> [
                'id' => $user->getRouteKey(),
                'name' => $user->name,
                'email' => $user->email,
                'verified' => $user->getRouteKey(),
                'admin' => $user->admin,
                'links' => [
                    'self' => url('/api/users/'.$user->getRouteKey()),
                ]
        ]]);
    }

    /** @test */
    public function can_fetch_all_user()
    {
        $this->withoutExceptionHandling();
        $user = User::factory(3)->create();
        $response = $this->getJson('/api/users/');
        $response->assertJson([]);
    }
}
