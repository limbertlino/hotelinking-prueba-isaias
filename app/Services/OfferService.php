<?php

namespace App\Services;

use App\Repositories\OfferRepository;
use App\Traits\ApiResponses;
use App\Models\User;


class OfferService
{
  use ApiResponses;
  protected $offerRepository;

  public function __construct(OfferRepository $offerRepository)
  {
    $this->offerRepository = $offerRepository;
  }

  public function index(User $user)
  {
    try {
      $offers = $this->offerRepository->index();

      return [
        'offers' => $offers,
        'user' => $user
      ];
    } catch (\Exception $e) {
      \Log::error('An error occurred while retrieving the tickets : ' . $e->getMessage());
      return null;
    }
  }

}