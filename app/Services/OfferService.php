<?php

namespace App\Services;

use App\Repositories\OfferRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PhpParser\Node\Stmt\TryCatch;


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