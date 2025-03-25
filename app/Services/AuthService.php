<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Handles authentication business logic.
 */
class AuthService
{
  use ApiResponses;
  protected $authRepository;

  public function __construct(AuthRepository $authRepository)
  {
    $this->authRepository = $authRepository;
  }

  /**
   * Authenticate user and generate access token.
   *
   * @param array $credentials ['email' => string, 'password' => string]
   * @return array|null ['user' => User, 'token' => string] or null on failure
   * @throws \Exception Logs error on authentication failure
   */
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

  /**
   * Revoke the current user's access token.
   *
   * @param Request $request
   * @return bool Always returns true
   */
  public function logout(Request $request)
  {
    $request->user()->currentAccessToken()->delete();
    return true;
  }

}