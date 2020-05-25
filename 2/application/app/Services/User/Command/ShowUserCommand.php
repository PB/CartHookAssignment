<?php
declare(strict_types=1);

namespace App\Services\User\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class ShowUserCommand
 *
 * @package App\Services\Item\Command
 */
class ShowUserCommand implements Arrayable
{
    /**
     * @var int
     */
    private $userId;

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
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
