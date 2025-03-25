<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponses;

/**
 * Handles user registration operations.
 */
class UserController extends Controller
{

    use ApiResponses;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Register a new user.
     * 
     * @param StoreUserRequest $request Validated user data
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData = $request->validated();

        $result = $this->userService->register($userData);

        if (!$result) {
            return $this->error('Error creating the user. Please try again later.', 422);
        }


        return $this->ok('New user created', [
            'user' => new UserResource($result['user'])
        ]);
    }

}
