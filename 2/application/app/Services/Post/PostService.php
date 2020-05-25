<?php
declare(strict_types=1);

namespace App\Services\Post;

use App\Services\Post\Command\ShowUserPostsCommand;
use App\Services\Post\Command\StoreUserPostsCommand;
use App\Services\Post\Handler\ShowUserPostsHandler;
use App\Services\Post\Handler\StoreUserPostsHandler;
use App\Services\Post\Validator\ShowUserPostsValidator;
use App\Services\Post\Validator\StoreUserPostsValidator;
use Joselfonseca\LaravelTactician\CommandBusInterface;

/**
 * Class PostService
 *
 * @package App\Services\Post
 */
class PostService implements PostServiceInterface
{

    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $bus;

    /**
     * PostService constructor.
     *
     * @param CommandBusInterface $bus
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
        $this->bus->addHandler(StoreUserPostsCommand::class, StoreUserPostsHandler::class);
        $this->bus->addHandler(ShowUserPostsCommand::class, ShowUserPostsHandler::class);
    }

    /**
     * @inheritDoc
     */
    public function storePosts(array $data = [])
    {
        return $this->bus->dispatch(StoreUserPostsCommand::class, $data, [StoreUserPostsValidator::class]);
    }

    /**
     * @inheritDoc
     */
    public function showUserPosts(array $data = [])
    {
        return $this->bus->dispatch(ShowUserPostsCommand::class, $data, [ShowUserPostsValidator::class]);
    }
}
