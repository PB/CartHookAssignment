<?php
declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCommentControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test index action
     *
     * @return void
     */
    public function testShowPostComments(): void
    {
        $response = $this->json('GET', '/api/posts/1/comments');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => 1,
                'name' => 'id labore ex et quam laborum'
            ]);
    }

    /**
     * Test show action with non exist menu
     *
     * @return void
     */
    public function testShowPostCommentsNotFound(): void
    {
        $response = $this->json('GET', '/api/posts/10000/comments');

        $response->assertStatus(404);
    }

    /**
     * Test show action with invalid menu
     *
     * @return void
     */
    public function testShowPostCommentsInvalid(): void
    {
        $response = $this->json('GET', '/api/posts/test/comments');

        $response->assertStatus(400);
    }
}
