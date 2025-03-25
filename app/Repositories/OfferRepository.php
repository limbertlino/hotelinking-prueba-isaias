<?php

namespace App\Repositories;
use App\Models\Offer;
use App\Models\User;

/**
 * Handles database operations for offers.
 */
class OfferRepository
{
  /**
   * Get all available offers.
   * 
   * @return \Illuminate\Database\Eloquent\Collection<Offer>
   */
  public function index()
  {
    return Offer::all();
  }
}