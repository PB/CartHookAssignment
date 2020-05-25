<?php
declare(strict_types=1);

namespace App\Services\Comment\Repository;

use App\Services\Comment\Exceptions\NotFoundException;
use App\Services\ApiClient;

/**
 * Class JsonPlaceHolderRepository
 *
 * @package App\Services\Item\Repository
 */
class JsonPlaceHolderRepository implements CommentRepositoryInterface
{
    /**
     * @var ApiClient
     */
    private ApiClient $client;

    /**
     * JsonPlaceHolderRepository constructor.
     *
     * @param ApiClient $client
     */
    public function __construct(ApiClient $client)
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
