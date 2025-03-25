<?php

namespace App\Services;

use App\Enums\CodeStatus;
use App\Models\Code;
use App\Repositories\UserCodeRepository;
use App\Traits\ApiResponses;
use App\Models\User;

/**
 * Handles business logic for user code operations (retrieval and redemption).
 */
class UserCodeService
{
  use ApiResponses;

  protected $userCodeRepository;

  public function __construct(UserCodeRepository $userCodeRepository)
  {
    $this->userCodeRepository = $userCodeRepository;
  }

  /**
   * Retrieve all codes belonging to a user.
   *
   * @param User $user
   * @return array|null ['codes' => Collection<Code>] or null on failure
   * @throws \Exception Logs error if retrieval fails
   */
  public function getUserCodes(User $user)
  {
    try {
      $codes = $this->userCodeRepository->getByUser($user);

      return [
        'codes' => $codes,
      ];
    } catch (\Exception $e) {
      \Log::error('Error fetching user codes: ' . $e->getMessage());
      return null;
    }
  }

  /**
   * Redeem a valid user code.
   *
   * @param User $user
   * @param Code $code
   * @return array|null ['code' => Code] if redeemed, null if invalid or error
   * @throws \Exception Logs error if redemption fails
   */
  public function redeemCode(User $user, Code $code)
  {
    try {
      if ($code->user_id !== $user->id) {
        return null;
      }

      if ($code->status === CodeStatus::Redeemed) {
        return null;
      }

      $redeemedCode = $this->userCodeRepository->redeem($code);

      return [
        'code' => $redeemedCode,
      ];
    } catch (\Exception $e) {
      \Log::error('Error redeeming code: ' . $e->getMessage());
      return null;
    }
  }



}