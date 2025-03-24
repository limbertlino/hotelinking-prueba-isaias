<?php

namespace App\Services;

use App\Enums\CodeStatus;
use App\Models\User;
use App\Models\Offer;
use App\Models\Code;
use App\Repositories\CodeRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Str;

class ClaimOfferService
{
  use ApiResponses;

  protected $codeRepository;

  public function __construct(CodeRepository $codeRepository)
  {
    $this->codeRepository = $codeRepository;
  }


  public function claimOffer(User $user, Offer $offer)
  {
    try {
      $code = $this->codeRepository->create([
        'code' => $this->generateUniqueCode(),
        'status' => CodeStatus::Active, // Usa el enum
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
