<?php
declare(strict_types=1);

namespace App\Services\User;

/**
 * Interface UserServiceInterface
 *
 * @package App\Services\User
 */
interface UserServiceInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function storeUsers(array $data = []);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function showUsers(array $data = []);

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function showUser(array $data = []);
}
