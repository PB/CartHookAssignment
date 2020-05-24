<?php
declare(strict_types=1);

namespace App\Services\Post\Repository;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;

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
     */
    public function showUserPosts(int $userId): array
    {
        return $this->client->getUserPosts($userId);
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
