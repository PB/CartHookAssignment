<?php
declare(strict_types=1);

namespace App\Services\User\Repository;

use App\Services\User\Repository\JsonPlaceHolderRepository;
use App\Services\User\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 *
 * @package App\Services\Item\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var JsonPlaceHolderRepository
     */
    private JsonPlaceHolderRepository $jsphRepository;

    /**
     * UserRepository constructor.
     *
     * @param \App\Services\User\Repository\JsonPlaceHolderRepository $jsphRepository
     */
    public function __construct(JsonPlaceHolderRepository $jsphRepository)
    {
        $this->jsphRepository = $jsphRepository;
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function showUser(int $userId): array
    {
        $user = User::find($userId);
        // fallback if DB is empty
        if ($user === null) {
            $user = $this->jsphRepository->showUser($userId);
        } else {
            $user = $user->toArray();
        }
        return  $user;
    }

    /**
     * @param int $limit
     *
     * @return array
     */
    public function showUsers(int $limit = 10): array
    {
        $users = User::limit($limit)->orderBy('id', 'ASC')->get();
        // fallback if DB is empty
        if ($users->isEmpty()) {
            $users = $this->jsphRepository->showUsers($limit);
        } else {
            $users = $users->toArray();
        }
        return  $users;
    }

    /**
     * @param array $data
     */
    public function storeUsers(array $data): void
    {
        User::insert($data);
    }

    /**
     * Truncate User table for compatibility with jsonapiplaceholder
     */
    public function clearUserData(): void
    {
        User::truncate();
    }
}
