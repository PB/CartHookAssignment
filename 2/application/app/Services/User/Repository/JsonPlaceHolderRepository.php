<?php
declare(strict_types=1);

namespace App\Services\User\Repository;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements UserRepositoryInterface
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
     * @param int $limit
     *
     * @return array
     */
    public function showUsers(int $limit = 10): array
    {
        $users = $this->client->getUsers();
        return \array_slice($users, 0, $limit);
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUser(int $userId): array
    {
        return $this->client->getUsers($userId);
    }

    /**
     * @param array $data
     */
    public function storeUsers(array $data): void
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     *
     */
    public function clearUserData(): void
    {
        throw new \RuntimeException('Not implemented');
    }
}
