<?php
declare(strict_types=1);

namespace App\Services\Comment\Repository;

use App\Comment;
use App\Services\Comment\Exceptions\NotFoundException;

/**
 * Class CommentRepository
 *
 * @package App\Services\Comment\Repository
 */
class CommentRepository implements CommentRepositoryInterface
{
    /**
     * @var JsonPlaceHolderRepository
     */
    private JsonPlaceHolderRepository $jsphRepository;

    /**
     * UserRepository constructor.
     *
     * @param \App\Services\Comment\Repository\JsonPlaceHolderRepository $jsphRepository
     */
    public function __construct(JsonPlaceHolderRepository $jsphRepository)
    {
        $this->jsphRepository = $jsphRepository;
    }


    /**
     * @param int $postId
     *
     * @return array
     * @throws NotFoundException
     */
    public function showPostComments(int $postId): array
    {
        $comments = Comment::where('post_id', $postId)->orderBy('id', 'ASC')->get();
        // fallback if DB is empty
        if ($comments->isEmpty()) {
            $comments = $this->jsphRepository->showPostComments($postId);
        } else {
            $comments = $comments->toArray();
        }

        return $comments;
    }

    /**
     * @param int   $postId
     * @param array $data
     */
    public function storeComments(int $postId, array $data): void
    {
        Comment::insert($data);
    }
}
