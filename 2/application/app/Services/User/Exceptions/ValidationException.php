<?php
declare(strict_types=1);

namespace App\Services\User\Exceptions;

use Illuminate\Http\JsonResponse;

class ValidationException extends \Exception
{
    /**
     * @var array
     */
    private array $errors;

    public function __construct(array $errors)
    {
        parent::__construct();
        $this->errors = $errors;
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json($this->errors, JsonResponse::HTTP_BAD_REQUEST);
    }
}
