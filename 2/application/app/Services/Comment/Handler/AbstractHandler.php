<?php
declare(strict_types=1);

namespace App\Services\Comment\Handler;

use App\Services\Comment\Repository\CommentRepositoryInterface;

/**
 * Class AbstractHandler
 *
 * @package App\Services\Comment\Handler
 */
abstract class AbstractHandler
{
    /**
     * @var CommentRepositoryInterface
     */
    protected CommentRepositoryInterface $commentRepository;

    /**
     * StoreMenuHandler constructor.
     *
     * @param CommentRepositoryInterface $commentRepository
     */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
}
