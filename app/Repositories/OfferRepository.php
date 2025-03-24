<?php

namespace App\Repositories;
use App\Models\Offer;
use App\Models\User;

class OfferRepository
{
  public function index()
  {
    return Offer::all();
  }
}