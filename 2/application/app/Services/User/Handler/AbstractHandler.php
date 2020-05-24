<?php
declare(strict_types=1);

namespace App\Services\User\Handler;

use App\Services\User\Repository\UserRepositoryInterface;

/**
 * Class AbstractHandler
 *
 * @package App\Services\User\Handler
 */
abstract class AbstractHandler
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * StoreMenuHandler constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
