<?php
declare(strict_types=1);

namespace App\Services\User\Handler;

use App\Services\User\Command\StoreUserCommand;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreUserHandler
 *
 * @package App\Services\Item\Handler
 */
class StoreUserHandler extends AbstractHandler
{
    /**
     * @param StoreUserCommand $command
     *
     * @return array
     */
    public function handle(StoreUserCommand $command): array
    {
        DB::beginTransaction();
        try {
            $users = $this->prepareInputData($command);
            $this->userRepository->clearUserData();
            $this->userRepository->storeUsers($users);
            DB::commit();

            return [
                'command' => $command,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * @param StoreUserCommand $command
     *
     * @return array
     * @throws \JsonException
     */
    public function prepareInputData(StoreUserCommand $command): array
    {
        $users = $command->toArray();
        foreach ($users as &$user) {
            $user['address'] = \json_encode($user['address'], JSON_THROW_ON_ERROR);
            $user['company'] = \json_encode($user['company'], JSON_THROW_ON_ERROR);
        }
        unset($user);

        return $users;
    }
}
