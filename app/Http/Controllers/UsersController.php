<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Service\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->userService->getUsers()
        ]);
    }

    public function store(UserRequest $request): JsonResponse
    {
        try {
            $flag = $this->userService->createUser($request->all());

            if (!$flag) {
                return response()->json(['message' => 'User already exists']);
            }

            return response()->json(['message' => 'Success'], 201);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function get(User $user)
    {
        try {
            return $this->userService->getUser($user);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User not found.']);
        }

    }

    public function update(User $user, Request $request): JsonResponse
    {
        $this->userService->updateUser($user, $request->all());

        return response()->json(['message' => 'User updated'], 200);
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user);

        return response()->json('', 204);
    }
}
