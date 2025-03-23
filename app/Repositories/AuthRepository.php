<?php

namespace App\Repositories;
use App\Models\User;

class AuthRepository
{
  public function findUserByEmail($email)
  {
    return User::firstWhere('email', $email);
  }
}