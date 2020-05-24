<?php
declare(strict_types=1);

namespace App\Services\Post\Handler;

use App\Services\Post\Command\ShowUserPostsCommand;

/**
 * Class ShowUserHandler
 *
 * @package App\Services\Post\Handler
 */
class ShowUserPostsHandler extends AbstractHandler
{

    /**
     * @param ShowUserPostsCommand $command
     *
     * @return array
     */
    public function handle(ShowUserPostsCommand $command): array
    {
        return [
            'command' => $command,
            'posts' => $this->postRepository->showUserPosts($command->getUserId())
        ];
    }
}
