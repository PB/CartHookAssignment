<?php
declare(strict_types=1);

namespace App\Services\Comment;

use App\Services\Comment\Command\ShowPostCommentsCommand;
use App\Services\Comment\Command\StorePostCommentsCommand;
use App\Services\Comment\Handler\ShowPostCommentsHandler;
use App\Services\Comment\Handler\StorePostCommentsHandler;
use App\Services\Comment\Validator\ShowPostCommentsValidator;
use App\Services\Comment\Validator\StorePostCommentsValidator;
use Joselfonseca\LaravelTactician\CommandBusInterface;

/**
 * Class CommentService
 *
 * @package App\Services\Comment
 */
class CommentService implements CommentServiceInterface
{

    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $bus;

    /**
     * CommentService constructor.
     *
     * @param CommandBusInterface $bus
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
        $this->bus->addHandler(StorePostCommentsCommand::class, StorePostCommentsHandler::class);
        $this->bus->addHandler(ShowPostCommentsCommand::class, ShowPostCommentsHandler::class);
    }

    /**
     * @inheritDoc
     */
    public function storeComments(array $data = [])
    {
        return $this->bus->dispatch(StorePostCommentsCommand::class, $data, [StorePostCommentsValidator::class]);
    }

    /**
     * @inheritDoc
     */
    public function showPostComments(array $data = [])
    {
        return $this->bus->dispatch(ShowPostCommentsCommand::class, $data, [ShowPostCommentsValidator::class]);
    }
}
