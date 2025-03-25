<?php

namespace App\Services;

use App\Repositories\OfferRepository;
use App\Traits\ApiResponses;
use App\Models\User;

/**
 * Handles business logic for offer-related operations.
 */
class OfferService
{
  use ApiResponses;
  protected $offerRepository;

  public function __construct(OfferRepository $offerRepository)
  {
    $this->offerRepository = $offerRepository;
  }

  /**
   * Retrieves all available offers along with user context.
   *
   * @param User $user The authenticated user
   * @return array|null ['offers' => Collection<Offer>, 'user' => User] or null on failure
   * @throws \Exception Logs error if retrieval fails
   */
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