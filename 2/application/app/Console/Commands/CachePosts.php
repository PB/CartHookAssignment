<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Post;
use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use App\Services\Post\PostServiceInterface;
use Illuminate\Console\Command;

class CachePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:posts {--limit=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache posts';
    /**
     * @var PostServiceInterface
     */
    private PostServiceInterface $postService;
    /**
     * @var JsonPlaceHolderClient
     */
    private JsonPlaceHolderClient $client;

    /**
     * Create a new command instance.
     *
     * @param PostServiceInterface  $postService
     * @param JsonPlaceHolderClient $client
     */
    public function __construct(PostServiceInterface $postService, JsonPlaceHolderClient $client)
    {
        parent::__construct();
        $this->postService = $postService;
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //todo: that should be also in command bus
        Post::truncate();
        $users = $this->client->getUsers();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        foreach ($users as $user) {
            $this->performTask($user['id']);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\nPosts data cached");
    }

    /**
     * @param int $userId
     */
    private function performTask(int $userId): void
    {
        $limit = is_string($this->option('limit'))? $this->option('limit') : 50;
        $posts = $this->client->getUserPosts($userId);
        $this->postService->storePosts([
            'userId' => $userId,
            'posts' => \array_slice($posts, 0, (int)$limit)
        ]);
    }
}
