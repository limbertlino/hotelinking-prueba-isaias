<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\ApiResponses;


class UserService
{
  use ApiResponses;
  protected $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

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