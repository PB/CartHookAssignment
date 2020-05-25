<?php
declare(strict_types=1);

namespace App\Services\User\Handler;

use App\Services\User\Command\ShowUserCommand;

/**
 * Class ShowUserHandler
 *
 * @package App\Services\User\Handler
 */
class ShowUserHandler extends AbstractHandler
{

    /**
     * @param ShowUserCommand $command
     *
     * @return array
     */
    public function handle(ShowUserCommand $command): array
    {
        return [
            'command' => $command,
            'user' => $this->userRepository->showUser((int)$command->getUserId())
        ];
    }
}
