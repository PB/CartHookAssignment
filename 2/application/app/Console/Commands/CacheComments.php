<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Comment;
use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;
use App\Services\Comment\CommentServiceInterface;
use Illuminate\Console\Command;

class CacheComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:comments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache comments';
    /**
     * @var CommentServiceInterface
     */
    private CommentServiceInterface $commentService;
    /**
     * @var JsonPlaceHolderClient
     */
    private JsonPlaceHolderClient $client;

    /**
     * Create a new command instance.
     *
     * @param CommentServiceInterface  $commentService
     * @param JsonPlaceHolderClient $client
     */
    public function __construct(CommentServiceInterface $commentService, JsonPlaceHolderClient $client)
    {
        parent::__construct();
        $this->commentService = $commentService;
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
            // truncate table to avoid duplicates (demo purposes only)
            Comment::truncate();

            $posts = $this->client->getPosts();
            $bar = $this->output->createProgressBar(count($posts));
            $bar->start();
            foreach ($posts as $post) {
                $this->performTask($post['id']);
                $bar->advance();
            }
            $bar->finish();
            $this->info("\nComments data cached");
        } catch (\Throwable $t) {
            $this->warn("\nUnable to fetch data. Please try again.");
        }
    }

    /**
     * @param int $postId
     */
    private function performTask(int $postId): void
    {
        $comments = $this->client->getPostComments($postId);
        $this->commentService->storeComments([
            'postId' => $postId,
            'comments' => $comments
        ]);
    }
}
