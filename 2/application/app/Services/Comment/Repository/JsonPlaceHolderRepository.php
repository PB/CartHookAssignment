<?php
declare(strict_types=1);

namespace App\Services\Comment\Repository;

use App\Services\Comment\Exceptions\NotFoundException;
use App\Services\JsonPlaceHolderClient\JsonPlaceHolderClient;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements CommentRepositoryInterface
{
    /**
     * @var JsonPlaceHolderClient
     */
    private JsonPlaceHolderClient $client;

    // todo: interface

    /**
     * JsonPlaceHolderRepository constructor.
     *
     * @param JsonPlaceHolderClient $client
     */
    public function __construct(JsonPlaceHolderClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $postId
     *
     * @return array
     * @throws NotFoundException
     */
    public function showPostComments(int $postId): array
    {
        $comments = $this->client->getPostComments($postId);

        if (empty($comments)) {
            throw new NotFoundException(['Comments not found']);
        }
        return $comments;
    }

    /**
     * @param int   $postId
     * @param array $data
     */
    public function storeComments(int $postId, array $data): void
    {
        throw new \RuntimeException('Not implemented');
    }
}
