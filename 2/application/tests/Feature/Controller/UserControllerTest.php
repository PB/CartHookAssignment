<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test index action
     *
     * @return void
     */
    public function testShowUsers(): void
    {
        $response = $this->json('GET', '/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id' => 1, 'name' => 'Leanne Graham']);
    }

    /**
     * Test show action
     *
     * @return void
     */
    public function testShowUser(): void
    {
        $response = $this->json('GET', '/api/users/1');

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['id' => 1, 'name' => 'Leanne Graham']);
    }

    /**
     * Test show action with non exist menu
     *
     * @return void
     */
    public function testShowUserNotFound(): void
    {
        $response = $this->json('GET', '/api/users/10000');

        $response->assertStatus(404);
    }

    /**
     * Test show action with invalid menu
     *
     * @return void
     */
    public function testShowUserInvalid(): void
    {
        $response = $this->json('GET', '/api/users/test');

        $response->assertStatus(400);
    }
}
