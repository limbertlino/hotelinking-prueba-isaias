<?php

namespace App\Repositories;
use App\Models\User;

/**
 * Handles database operations for user management.
 */
class UserRepository
{
  /**
   * Create a new user in the database.
   *
   * @param array $userData User attributes (must match fillable fields)
   * @return User The newly created user instance
   */
  public function createNewUser($model)
  {
    return User::create($model);
  }
}