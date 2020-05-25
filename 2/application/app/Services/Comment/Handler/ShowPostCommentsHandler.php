<?php
declare(strict_types=1);

namespace App\Services\Comment\Handler;

use App\Services\Comment\Command\ShowPostCommentsCommand;

/**
 * Class ShowPostCommentsHandler
 *
 * @package App\Services\Comment\Handler
 */
class ShowPostCommentsHandler extends AbstractHandler
{

    /**
     * @param ShowPostCommentsCommand $command
     *
     * @return array
     */
    public function handle(ShowPostCommentsCommand $command): array
    {
        return [
            'command' => $command,
            'comments' => $this->commentRepository->showPostComments((int)$command->getPostId())
        ];
    }
}
