<?php

namespace App\Http\Controllers;

use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * UserController constructor.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->userService->showUsers();

        return response()->json($data['users'] ?? []);
    }

    /**
     * Display the specified resource.
     *
     * @param mixed $userId
     *
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        try {
            $data = $this->userService->showUser(['userId' => $userId]);

            return response()->json($data['user'] ?? []);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return response()->json([], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
