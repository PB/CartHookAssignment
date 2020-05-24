<?php
declare(strict_types=1);

namespace App\Services\Post\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ShowUserCommand
 *
 * @package App\Services\Post\Command
 */
class ShowUserPostsCommand implements Arrayable
{
    /**
     * @var int
     */
    private int $userId;

    /**
     * ShowUserCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->userId = $data['userId'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'userId' => $this->userId
        ];
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
