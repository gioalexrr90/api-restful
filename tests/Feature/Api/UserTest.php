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
    public function api_esta_activa()
    {
        $response = $this->getJson('api/users/');
        $response ->assertStatus(200);
    }

    /** @test */
    public function busqueda_de_un_item()
    {
        $user = User::factory()->create();
        $response = $this->getJson('/api/users/'.$user->getRouteKey());
        $response->assertExactJson([
            'data'=> [
                'id' => $user->getRouteKey(),
                'name' => $user->name,
                'email' => $user->email,
                'verified' => (int) $user->verified,
                'admin' => (int) $user->admin,
                'links' => [
                    'self' => url('/api/users/'.$user->getRouteKey()),
                ]
        ]]);
    }

    /** @test */
    public function mustra_todos_los_items()
    {
        $cantidadUsuarios = 3;
        $user = User::factory($cantidadUsuarios)->create();
        $response = $this->getJson('/api/users/');
        $response->assertJson([]);
    }
}
