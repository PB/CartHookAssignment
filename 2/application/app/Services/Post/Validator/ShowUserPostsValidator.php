<?php
declare(strict_types=1);

namespace App\Services\Post\Validator;

use App\Services\Post\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

/**
 * Class ShowUserPostsValidator
 *
 * @package App\Services\User\Validator
 */
class ShowUserPostsValidator implements Middleware
{

    /**
     * @var array
     */
    protected array $rules = [
        'userId' => 'required|integer',
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
        $validator = Validator::make($command->toArray(), $this->rules);
        if ($validator->fails()) {
            throw new ValidationException($validator->errors()->toArray());
        }
        return $next($command);
    }
}
