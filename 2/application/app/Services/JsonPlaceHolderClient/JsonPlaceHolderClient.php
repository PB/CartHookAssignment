<?php
declare(strict_types=1);

namespace App\Services\JsonPlaceHolderClient;

use App\Services\ApiClient;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class JsonPlaceHolderClient
 *
 * @package App\Services\JsonPlaceHolderClient
 */
class JsonPlaceHolderClient implements ApiClient
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * JsonPlaceHolderClient constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param int|null $userId
     *
     * @return array
     */
    public function getUsers(?int $userId = null): array
    {
        $response = $this->client->get('users/' . $userId ?? null);
        return self::handleResponse($response);
    }

    /**
     * @param int|null $postId
     *
     * @return array
     */
    public function getPosts(?int $postId = null): array
    {
        $response = $this->client->get('posts/' . $postId ?? null);
        return self::handleResponse($response);
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        $response = $this->client->get('comments');
        return self::handleResponse($response);
    }

    /**
     * @param int $userId
     *
     * @return array
     */
    public function getUserPosts(int $userId): array
    {
        $response = $this->client->get('user/' . $userId . '/posts', );
        return self::handleResponse($response);
    }

    /**
     * @param int $postId
     *
     * @return array
     */
    public function getPostComments(int $postId): array
    {
        $response = $this->client->get('post/' . $postId . '/comments', );
        return self::handleResponse($response);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return array
     */
    private static function handleResponse(ResponseInterface $response): array
    {
        try {
            return \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new \RuntimeException('Unable to decode JSON');
        }
    }
}
