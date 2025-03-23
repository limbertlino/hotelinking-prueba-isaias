<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthService
{
  use ApiResponses;
  protected $authRepository;

  public function __construct(AuthRepository $authRepository)
  {
    $this->authRepository = $authRepository;
  }

  public function login($credentials)
  {

    try {

      if (!Auth::attempt($credentials)) {
        return null;
      }

      $user = $this->authRepository->findUserByEmail($credentials['email']);

      $token = $user->createToken('API token for ' . $user->email, ['*'], now()->addMonth())->plainTextToken;


      return [
        'user' => $user,
        'token' => $token
      ];
    } catch (\Exception $e) {
      \Log::error('Error during login: ' . $e->getMessage());
      return null;
    }
  }

  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return true;
  }

}