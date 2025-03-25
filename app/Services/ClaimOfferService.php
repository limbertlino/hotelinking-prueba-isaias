<?php

namespace App\Services;

use App\Enums\CodeStatus;
use App\Models\User;
use App\Models\Offer;
use App\Repositories\UserCodeRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Str;

/**
 * Handles the business logic for claiming offers and generating redemption codes.
 */
class ClaimOfferService
{
  use ApiResponses;

  protected $userCodeRepository;

  public function __construct(UserCodeRepository $userCodeRepository)
  {
    $this->userCodeRepository = $userCodeRepository;
  }


  /**
   * Claim an offer for a user and generate a unique redemption code.
   *
   * @param User $user The user claiming the offer
   * @param Offer $offer The offer being claimed
   * @return array|null ['code' => Code] on success, null on failure
   * @throws \Exception Logs error if claiming fails
   */
  public function claimOffer(User $user, Offer $offer)
  {
    try {
      $code = $this->userCodeRepository->create([
        'code' => $this->generateUniqueCode(),
        'status' => CodeStatus::Active,
        'user_id' => $user->id,
        'offer_id' => $offer->id,
      ]);

      return [
        'code' => $code,
      ];
    } catch (\Exception $e) {
      \Log::error('Error claiming offer: ' . $e->getMessage());
      return null;
    }
  }

  /**
   * Generates a unique 7-character uppercase code.
   *
   * @return string The generated code
   */
  protected function generateUniqueCode(): string
  {
    return Str::upper(Str::random(7));
  }
}
