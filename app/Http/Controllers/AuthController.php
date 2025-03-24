<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\TokenResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponses;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponses;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials);

        if (!$result) {
            return $this->error('Invalid credentials', 401);
        }

        $userResource = new UserResource($result['user']);
        $tokenResource = new TokenResource($result['token']);

        return $this->ok('Authenticated', [
            'user' => $userResource,
            'token' => $tokenResource
        ]);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return $this->ok('Logged out successfully');
    }

}
