<?php

namespace App\Services;

/**
 * Interface ApiClient
 *
 * @package App\Services
 */
interface ApiClient
{
    /**
     * @param int|null $userId
     *
     * @return array
     */
    public function getUsers(?int $userId = null): array;

    /**
     * @param int|null $postId
     *
     * @return array
     */
    public function getPosts(?int $postId = null): array;

    /**
     * @return array
     */
    public function getComments(): array;

    /**
     * @param int $userId
     *
     * @return array
     */
    public function getUserPosts(int $userId): array;

    /**
     * @param int $postId
     *
     * @return array
     */
    public function getPostComments(int $postId): array;
}
