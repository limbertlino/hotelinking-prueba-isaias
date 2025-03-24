<?php

namespace App\Services;

use App\Enums\CodeStatus;
use App\Models\User;
use App\Models\Offer;
use App\Repositories\UserCodeRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Str;

class ClaimOfferService
{
  use ApiResponses;

  protected $userCodeRepository;

  public function __construct(UserCodeRepository $userCodeRepository)
  {
    $this->userCodeRepository = $userCodeRepository;
  }

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

  protected function generateUniqueCode(): string
  {
    return Str::upper(Str::random(7));
  }
}
