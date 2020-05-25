<?php
declare(strict_types=1);

namespace App\Services\User\Command;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class StoreUserCommand
 *
 * @package App\Services\User\Command
 */
class StoreUserCommand implements Arrayable
{
    /**
     * @var array
     */
    private array $data;

    /**
     * StoreUserCommand constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
