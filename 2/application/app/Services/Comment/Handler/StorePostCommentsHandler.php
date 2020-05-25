<?php
declare(strict_types=1);

namespace App\Services\Comment\Handler;

use App\Services\Comment\Command\StorePostCommentsCommand;
use Illuminate\Support\Facades\DB;

/**
 * Class StorePostCommentsHandler
 *
 * @package App\Services\Comment\Handler
 */
class StorePostCommentsHandler extends AbstractHandler
{
    /**
     * @param StorePostCommentsCommand $command
     *
     * @return array
     */
    public function handle(StorePostCommentsCommand $command): array
    {
        DB::beginTransaction();
        try {
            $comments = $this->prepareInputData($command->getComments());
            $this->commentRepository->storeComments($command->getPostId(), $comments);
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
     * @param array $comments
     *
     * @return array
     */
    private function prepareInputData(array $comments) : array
    {
        // map postId to post_id (DB friendly)
        foreach ($comments as &$comment) {
            $comment['post_id'] = $comment['postId'];
            unset($comment['postId']);
        }
        return $comments;
    }
}
