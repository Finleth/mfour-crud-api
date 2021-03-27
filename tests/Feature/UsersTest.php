<?php

namespace Tests\Feature;

use App\Models\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * Test GET /users with no authentication
     *
     * @return void
     */
    public function testGetUserListNoAuthorization()
    {
        $this->json('GET', '/api/users', [], ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'error' => 'No authorization provided.'
            ]);
    }

    /**
     * Test GET /users with bad authentication
     *
     * @return void
     */
    public function testGetUserListUnauthorized()
    {
        $this->json('GET', '/api/users', [], ['Authorization' => 'Bearer faketoken', 'Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                'error' => 'Invalid credentials.'
            ]);
    }

    /**
     * Test GET /users
     *
     * @return void
     */
    public function testGetUserList()
    {
        $this->json('GET', '/api/users', [], ['Authorization' => 'Bearer ' . config('app.api_key'), 'Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([]);
    }

    /**
     * Test POST /users/create
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = [
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'email' => 'test@test.com'
        ];

        $response = $this->json('POST', '/api/users/create', $user, ['Authorization' => 'Bearer ' . config('app.api_key'), 'Accept' => 'application/json'])
            ->assertStatus(201);

        return (int) $response->decodeResponseJson()['id'];
    }

    /**
     * Test POST /users/update/<user_id>
     * 
     * @depends testCreateUser
     *
     * @return void
     */
    public function testUpdateUser(int $userId)
    {
        $user = [
            'first_name' => 'Mary'
        ];

        $this->json('POST', '/api/users/update/' . $userId, $user, ['Authorization' => 'Bearer ' . config('app.api_key'), 'Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
