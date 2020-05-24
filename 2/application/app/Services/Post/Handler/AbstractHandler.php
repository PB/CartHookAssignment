<?php
declare(strict_types=1);

namespace App\Services\Post\Handler;

use App\Services\Post\Repository\PostRepositoryInterface;

/**
 * Class AbstractHandler
 *
 * @package App\Services\Post\Handler
 */
abstract class AbstractHandler
{
    /**
     * @var PostRepositoryInterface
     */
    protected PostRepositoryInterface $postRepository;

    /**
     * StoreMenuHandler constructor.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
}
