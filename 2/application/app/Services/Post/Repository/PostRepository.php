<?php
declare(strict_types=1);

namespace App\Services\Post\Repository;

use App\Post;

/**
 * Class PostRepository
 *
 * @package App\Services\Post\Repository
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var JsonPlaceHolderRepository
     */
    private JsonPlaceHolderRepository $jsphRepository;

    /**
     * UserRepository constructor.
     *
     * @param \App\Services\Post\Repository\JsonPlaceHolderRepository $jsphRepository
     */
    public function __construct(JsonPlaceHolderRepository $jsphRepository)
    {
        $this->jsphRepository = $jsphRepository;
    }


    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUserPosts(int $userId): array
    {
        $posts = Post::where('user_id', $userId)->orderBy('id', 'ASC')->get();
        // fallback if DB is empty
        if ($posts->isEmpty()) {
            $posts = $this->jsphRepository->showUserPosts($userId);
        } else {
            $posts = $posts->toArray();
        }
        return $posts;
    }

    /**
     * @param int   $userId
     * @param array $data
     */
    public function storePosts(int $userId, array $data): void
    {
        Post::insert($data);
    }
}
