<?php
declare(strict_types=1);

namespace App\Services\User\Repository;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Services\User\Repository
 */
interface UserRepositoryInterface
{
    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUser(int $userId): array;

    /**
     * @param int $limit
     *
     * @return array
     */
    public function showUsers(int $limit = 10): array;

    /**
     * @param array $data
     */
    public function storeUsers(array $data): void;

    /**
     * Clear DB (where possible)
     */
    public function clearUserData(): void;
}
