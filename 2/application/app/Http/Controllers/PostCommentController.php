<?php

namespace App\Http\Controllers;

use App\Services\Comment\CommentServiceInterface;
use Illuminate\Http\JsonResponse;

class PostCommentController extends Controller
{

    /**
     * @var CommentServiceInterface
     */
    private CommentServiceInterface $commentService;

    /**
     * UserController constructor.
     *
     * @param CommentServiceInterface $commentService
     */
    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display the specified resource.
     *
     * @param int $postId
     *
     * @return JsonResponse
     */
    public function index($postId): JsonResponse
    {
        try {
            $data = $this->commentService->showPostComments(['postId' => $postId]);

            return response()->json($data['comments'] ?? []);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json([], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
