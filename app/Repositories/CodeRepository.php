<?php

namespace App\Repositories;

use App\Models\Code;

class CodeRepository
{
  public function create(array $data)
  {
    return Code::create($data);
  }
}