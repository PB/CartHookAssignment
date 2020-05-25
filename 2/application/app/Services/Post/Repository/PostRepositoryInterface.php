<?php
declare(strict_types=1);

namespace App\Services\Post\Repository;

/**
 * Interface PostRepositoryInterface
 *
 * @package App\Services\Post\Repository
 */
interface PostRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUserPosts(int $userId): array;

    /**
     * @param int   $userId
     * @param array $data
     */
    public function storePosts(int $userId, array $data): void;
}
