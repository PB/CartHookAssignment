<?php

namespace App\Http\Controllers;

use App\Services\User\Repository\UserRepository;
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
     * @param int $userId
     *
     * @return JsonResponse
     */
    public function show(int $userId): JsonResponse
    {
        $data = $this->userService->showUser(['userId' => $userId]);

        return response()->json($data['user'] ?? []);
    }
}
