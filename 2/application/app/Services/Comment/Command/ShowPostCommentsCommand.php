<?php
declare(strict_types=1);

namespace App\Services\Comment\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ShowPostCommentsCommand
 *
 * @package App\Services\Post\Command
 */
class ShowPostCommentsCommand implements Arrayable
{
    /**
     * @var mixed
     */
    private $postId;

    /**
     * ShowUserCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->postId = $data['postId'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'postId' => $this->postId
        ];
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }
}
