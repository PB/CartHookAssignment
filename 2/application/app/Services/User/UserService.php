<?php
declare(strict_types=1);

namespace App\Services\User;

use App\Services\User\Command\ShowUserCommand;
use App\Services\User\Command\ShowUsersCommand;
use App\Services\User\Command\StoreUserCommand;
use App\Services\User\Handler\ShowUserHandler;
use App\Services\User\Handler\ShowUsersHandler;
use App\Services\User\Handler\StoreUserHandler;
use App\Services\User\Validator\ShowUserValidator;
use App\Services\User\Validator\StoreUserValidator;
use Joselfonseca\LaravelTactician\CommandBusInterface;

/**
 * Class UserService
 *
 * @package App\Services\User
 */
class UserService implements UserServiceInterface
{

    /**
     * @var CommandBusInterface
     */
    private CommandBusInterface $bus;

    /**
     * UserService constructor.
     *
     * @param CommandBusInterface $bus
     */
    public function __construct(CommandBusInterface $bus)
    {
        $this->bus = $bus;
        $this->bus->addHandler(StoreUserCommand::class, StoreUserHandler::class);
        $this->bus->addHandler(ShowUsersCommand::class, ShowUsersHandler::class);
        $this->bus->addHandler(ShowUserCommand::class, ShowUserHandler::class);
    }

    /**
     * @inheritDoc
     */
    public function storeUsers(array $data = [])
    {
        return $this->bus->dispatch(StoreUserCommand::class, $data, [StoreUserValidator::class]);
    }

    /**
     * @inheritDoc
     */
    public function showUsers(array $data = [])
    {
        return $this->bus->dispatch(ShowUsersCommand::class, $data, []);
    }

    /**
     * @inheritDoc
     */
    public function showUser(array $data = [])
    {
        return $this->bus->dispatch(ShowUserCommand::class, $data, [ShowUserValidator::class]);
    }
}
