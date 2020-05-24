<?php
declare(strict_types=1);

namespace App\Services\User\Handler;

use App\Services\User\Command\ShowUsersCommand;

/**
 * Class ShowUserHandler
 *
 * @package App\Services\User\Handler
 */
class ShowUsersHandler extends AbstractHandler
{

    /**
     * @param ShowUsersCommand $command
     *
     * @return array
     */
    public function handle(ShowUsersCommand $command): array
    {
        return [
            'command' => $command,
            'users' => $this->userRepository->showUsers()
        ];
    }
}
