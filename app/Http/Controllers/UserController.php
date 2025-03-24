<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponses;

class UserController extends Controller
{

    use ApiResponses;

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    
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
