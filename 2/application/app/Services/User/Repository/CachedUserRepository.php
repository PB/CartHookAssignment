<?php
declare(strict_types=1);

namespace App\Services\User\Repository;

use Illuminate\Support\Facades\Cache;

/**
 * Class UserRepository
 *
 * @package App\Services\Item\Repository
 */
class CachedUserRepository implements UserRepositoryInterface
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserRepository constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUser(int $userId): array
    {
        $key = $this->getUserCacheKey($userId);
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $user = $this->userRepository->showUser($userId);
        Cache::forever($key, $user);

        return $user;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function showUsers(int $limit = 10): array
    {
        return $this->userRepository->showUsers($limit);
    }

    /**
     * @param array $data
     *
     * @throws \JsonException
     */
    public function storeUsers(array $data): void
    {
        $this->userRepository->storeUsers($data);
        // put users already in cache
        foreach ($data as &$user) {
            $user['address'] = \json_decode($user['address'], true, 512, JSON_THROW_ON_ERROR);
            $user['company'] = \json_decode($user['company'], true, 512, JSON_THROW_ON_ERROR);
            Cache::forever($this->getUserCacheKey($user['id']), $user);
            // this cache is set for demo purposes
            Cache::forever($this->getUserEmailCacheKey($user['email']), $user);
        }
    }

    /**
     * Truncate User table for compatibility with jsonapiplaceholder
     */
    public function clearUserData(): void
    {
        $this->userRepository->clearUserData();
        // dirty way to remove from cache (only for demo purposes)
        Cache::flush();
    }

    /**
     * @param int $userId
     *
     * @return string
     */
    private function getUserCacheKey(int $userId): string
    {
        return md5('user_' . $userId);
    }

    /**
     * @param string $email
     *
     * @return string
     */
    private function getUserEmailCacheKey(string $email): string
    {
        return md5('user_email_' . $email);
    }
}
