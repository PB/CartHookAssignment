<?php
declare(strict_types=1);

namespace App\Services\Comment;

/**
 * Interface CommentServiceInterface
 *
 * @package App\Services\Comment
 */
interface CommentServiceInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function storeComments(array $data = []);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function showPostComments(array $data = []);
}
