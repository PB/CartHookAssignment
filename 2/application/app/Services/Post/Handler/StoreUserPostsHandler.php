<?php
declare(strict_types=1);

namespace App\Services\Post\Handler;

use App\Services\Post\Command\StoreUserPostsCommand;
use Illuminate\Support\Facades\DB;

/**
 * Class StoreUserPostsHandler
 *
 * @package App\Services\Post\Handler
 */
class StoreUserPostsHandler extends AbstractHandler
{
    /**
     * @param StoreUserPostsCommand $command
     *
     * @return array
     */
    public function handle(StoreUserPostsCommand $command): array
    {
        DB::beginTransaction();
        try {
            $posts = $this->prepareInputData($command->getPosts());
            $this->postRepository->storePosts($command->getUserId(), $posts);
            DB::commit();

            return [
                'command' => $command,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * @param array $posts
     *
     * @return array
     */
    private function prepareInputData(array $posts) : array
    {
        // map userId to user_id (DB friendly)
        foreach ($posts as &$post) {
            $post['user_id'] = $post['userId'];
            unset($post['userId']);
        }
        return $posts;
    }
}
