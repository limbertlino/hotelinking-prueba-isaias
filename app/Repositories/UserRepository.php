<?php

namespace App\Repositories;
use App\Models\User;

class UserRepository
{
  public function createNewUser($model)
  {
    return User::create($model);
  }
}