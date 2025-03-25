<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ApiResponses;

/**
 * Handles business logic for user operations such as registration.
 */
class UserService
{
  use ApiResponses;
  protected $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  /**
   * Registers a new user with the provided data.
   *
   * @param array $data
   * @return array|null ['user' => User] if registration is successful, null if failed
   * @throws \Exception Logs error if registration fails
   */
  public function register($data)
  {
    try {
      $newUser = $this->userRepository->createNewUser($data);

      return [
        'user' => $newUser,
      ];
    } catch (\Exception $e) {
      \Log::error('Error al registrar usuario: ' . $e->getMessage());
      return null;
    }
  }

}