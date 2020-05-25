<?php

namespace App\Console\Commands;

use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use App\Services\User\UserServiceInterface;
use Illuminate\Console\Command;

class CacheUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache users';
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;
    /**
     * @var JsonPlaceHolderClient
     */
    private JsonPlaceHolderClient $client;

    /**
     * Create a new command instance.
     *
     * @param UserServiceInterface  $userService
     * @param JsonPlaceHolderClient $client
     */
    public function __construct(UserServiceInterface $userService, JsonPlaceHolderClient $client)
    {
        parent::__construct();
        $this->userService = $userService;
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->userService->storeUsers($this->client->getUsers());
            $this->info('Users data cached');
        } catch (\Throwable $t) {
            $this->warn("\nUnable to fetch data. Please try again.");
        }
    }
}
