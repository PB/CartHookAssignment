<?php
declare(strict_types=1);

namespace App\Services\Comment\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class StorePostCommentsCommand
 *
 * @package App\Services\Comment\Command
 */
class StorePostCommentsCommand implements Arrayable
{
    /**
     * @var array
     */
    private array $comments;

    /**
     * @var int
     */
    private $postId;

    /**
     * StorePostCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->postId = $data['postId'];
        $this->comments = $data['comments'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'postId' => $this->postId,
            'comments' => $this->comments
        ];
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->postId;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }
}
