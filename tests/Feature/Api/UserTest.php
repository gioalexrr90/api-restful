<?php

namespace Tests\Feature\Api;

use App\Models\User as ModelsUser;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_fetch_sigle_user()
    {
        /* $response = $this->get('/');

        $response->assertStatus(200); */

        $user = UserFactory::new()->create();
        $response = $this->getJson('api/users/' . $user->getRouteKey());
        $response ->assertSee($user->name);
    }
}
