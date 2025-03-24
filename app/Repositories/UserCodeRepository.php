<?php

namespace App\Repositories;

use App\Enums\CodeStatus;
use App\Models\User;
use App\Models\Code;

class UserCodeRepository
{
  public function getByUser(User $user)
  {
    return Code::where('user_id', $user->id)->with('offer')->get();
  }

  public function create(array $data)
  {
    return Code::create($data);
  }

  public function redeem(Code $code)
  {
    $code->update([
      'status' => CodeStatus::Redeemed,
      'redeemed_at' => now(),
    ]);

    return $code;
  }


}