<?php
declare(strict_types=1);

namespace App\Services\Post\Repository;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use App\Services\Post\Exceptions\NotFoundException;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements PostRepositoryInterface
{
    /**
     * @var JsonPlaceHolderClient
     */
    private JsonPlaceHolderClient $client;

    // todo: interface

    /**
     * JsonPlaceHolderRepository constructor.
     *
     * @param JsonPlaceHolderClient $client
     */
    public function __construct(JsonPlaceHolderClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $userId
     *
     * @return array
     * @throws NotFoundException
     */
    public function showUserPosts(int $userId): array
    {
        $posts = $this->client->getUserPosts($userId);
        if (empty($posts)) {
            throw new NotFoundException(['Comments not found']);
        }

        return  $posts;
    }

    /**
     * @param int   $userId
     * @param array $data
     */
    public function storePosts(int $userId, array $data): void
    {
        throw new \RuntimeException('Not implemented');
    }
}
