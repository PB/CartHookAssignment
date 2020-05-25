<?php
declare(strict_types=1);

namespace App\Services\Post\Repository;

use App\Services\ApiClient;
use App\Services\Post\Exceptions\NotFoundException;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements PostRepositoryInterface
{
    /**
     * @var ApiClient
     */
    private ApiClient $client;

    /**
     * JsonPlaceHolderRepository constructor.
     *
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
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
