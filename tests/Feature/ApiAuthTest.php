<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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

    public function test_auth_user()
    {
        $token = Str::random(80);

        $user = User::factory()->create([
            'api_token' => hash('sha256', $token),
        ]);

        $response = $this->json('GET', "/api/user?api_token={$token}");

        $responseArray = $response->json();

        $this->assertEquals($user->toArray(), $responseArray);
    }

    public function test_auth_ranking()
    {
        $token = Str::random(80);
        $user = User::factory()->create([
            'api_token' => hash('sha256', $token),
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->json('POST', '/api/ranking', [
            'correctRatio' => 5,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('rankings', [
            'percentage_correct_answer' => 50,
            'user_id' => $user->id,
        ]);
    }
}
