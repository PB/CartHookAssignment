<?php
declare(strict_types=1);

namespace App\Services\Post;

/**
 * Interface UserServiceInterface
 *
 * @package App\Services\Post
 */
interface PostServiceInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function storePosts(array $data = []);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function showUserPosts(array $data = []);
}
