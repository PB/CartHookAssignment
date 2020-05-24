<?php
declare(strict_types=1);

namespace App\Services\Post\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class StoreUserPostsCommand
 *
 * @package App\Services\Post\Command
 */
class StoreUserPostsCommand implements Arrayable
{
    /**
     * @var array
     */
    private array $posts;

    /**
     * @var int
     */
    private $userId;

    /**
     * StoreUserCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->userId = $data['userId'];
        $this->posts = $data['posts'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'posts' => $this->posts
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}
