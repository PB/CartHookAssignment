<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPostControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test index action
     *
     * @return void
     */
    public function testShowUserPosts(): void
    {
        $response = $this->json('GET', '/api/users/1/posts');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                'title' => 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit'
            ]);
    }

    /**
     * Test show action with non exist menu
     *
     * @return void
     */
    public function testShowUserPostsNotFound(): void
    {
        $response = $this->json('GET', '/api/users/10000/posts');

        // jsonplaceholder returns 200 instead of 404
        $response->assertStatus(200);
    }

    /**
     * Test show action with invalid menu
     *
     * @return void
     */
    public function testShowUserPostInvalid(): void
    {
        $response = $this->json('GET', '/api/users/test/posts');

        $response->assertStatus(400);
    }
}
