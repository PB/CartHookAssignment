<?php
declare(strict_types=1);

namespace App\Services\Comment\Repository;

/**
 * Interface CommentRepositoryInterface
 *
 * @package App\Services\Comment\Repository
 */
interface CommentRepositoryInterface
{
    /**
     * @param int $postId
     *
     * @return array
     */
    public function showPostComments(int $postId): array;

    /**
     * @param int   $postId
     * @param array $data
     */
    public function storeComments(int $postId, array $data): void;
}
