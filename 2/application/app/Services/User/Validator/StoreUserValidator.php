<?php
declare(strict_types=1);

namespace App\Services\User\Validator;

use App\Services\User\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use League\Tactician\Middleware;

/**
 * Class StoreUserValidator
 *
 * @package App\Services\User\Validator
 */
class StoreUserValidator implements Middleware
{
    /**
     * @var array
     */
    protected $rules = [

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
