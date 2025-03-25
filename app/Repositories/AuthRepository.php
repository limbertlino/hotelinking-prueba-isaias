<?php

namespace App\Repositories;
use App\Models\User;

/**
 * Handles authentication-related database operations.
 */
class AuthRepository
{
  /**
   * Find a user by their email address.
   *
   * @param string $email The email address to search for
   * @return User|null The found user or null if not exists
   */
  public function findUserByEmail($email)
  {
    return User::firstWhere('email', $email);
  }
}