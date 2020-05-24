<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Post\PostServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    /**
     * @var PostServiceInterface
     */
    private PostServiceInterface $postService;

    /**
     * UserController constructor.
     *
     * @param PostServiceInterface $postService
     */
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display the specified resource.
     *
     * @param int $userId
     *
     * @return JsonResponse
     */
    public function index(int $userId): JsonResponse
    {
        $data = $this->postService->showUserPosts(['userId' => $userId]);

        return response()->json($data['posts'] ?? []);
    }
}
