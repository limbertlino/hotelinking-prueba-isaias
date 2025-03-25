<?php

namespace App\Repositories;

use App\Enums\CodeStatus;
use App\Models\User;
use App\Models\Code;

/**
 * Handles database operations for user codes management.
 */
class UserCodeRepository
{
  /**
   * Get all codes belonging to a specific user with their associated offers.
   *
   * @param User $user
   * @return \Illuminate\Database\Eloquent\Collection<Code>
   */
  public function getByUser(User $user)
  {
    return Code::where('user_id', $user->id)->with('offer')->get();
  }

  /**
   * Create a new code record.
   *
   * @param array $data
   * @return Code
   */
  public function create(array $data)
  {
    return Code::create($data);
  }

  /**
   * Mark a code as redeemed.
   *
   * @param Code $code
   * @return Code
   */
  public function redeem(Code $code)
  {
    $code->update([
      'status' => CodeStatus::Redeemed,
      'redeemed_at' => now(),
    ]);

    return $code;
  }

}