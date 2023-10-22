<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_auth()
    {
        $data = [
            'name' => 'test',
            'email' => 'testUser@example.com',
            'password' => 'password111',
            'password_confirmation' => 'password111',
        ];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'test',
            'email' => 'testUser@example.com',
        ]);

        $response = $this->json('POST', '/api/login', [
            'email' => 'testUser@example.com',
            'password' => 'password111',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
            ]);

        Auth::logout();

        $token = $response->decodeResponseJson()['token'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->json('POST', '/api/logout');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'logout'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'testUser@example.com',
            'api_token' => null
        ]);
    }
}
