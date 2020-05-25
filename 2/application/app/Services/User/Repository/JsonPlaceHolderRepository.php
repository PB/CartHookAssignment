<?php
declare(strict_types=1);

namespace App\Services\User\Repository;

use App\Services\ApiClient;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements UserRepositoryInterface
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
