<?php
declare(strict_types=1);

namespace App\Services\Post\Validator;

use App\Services\User\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

/**
 * Class StoreUserPostValidator
 *
 * @package App\Services\Post\Validator
 */
class StoreUserPostsValidator implements Middleware
{
    /**
     * @var array
     */
    protected $rules = [
        'userId' => 'required|integer',
        'posts' => 'required|array'
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
