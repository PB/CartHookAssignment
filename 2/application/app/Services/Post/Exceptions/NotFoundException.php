<?php
declare(strict_types=1);

namespace App\Services\Post\Exceptions;

use Illuminate\Http\JsonResponse;

class NotFoundException extends \Exception
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
        return response()->json($this->errors, JsonResponse::HTTP_NOT_FOUND);
    }
}
