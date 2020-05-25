<?php
declare(strict_types=1);

namespace App\Services\Comment\Validator;

use App\Services\Comment\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

/**
 * Class StorePostCommentsValidator
 *
 * @package App\Services\Comment\Validator
 */
class StorePostCommentsValidator implements Middleware
{
    /**
     * @var array
     */
    protected $rules = [
        'postId' => 'required|integer',
        'comments' => 'required|array'
    ];

    /**
     * @param object   $command
     * @param callable $next
     *
     * @return mixed
     * @throws ValidationException
     */
    public function execute($command, callable $next)
    {
        // todo: here should be validation
        $validator = Validator::make($command->toArray(), $this->rules);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->toArray());
        }

        return $next($command);
    }
}
