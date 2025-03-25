<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferResource;
use App\Services\OfferService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;


/**
 * Controller for managing user-specific offers.
 */
class UserOfferController extends Controller
{

    use ApiResponses;

    protected $offerService;

    public function __construct(OfferService $offerService)
    {
        $this->offerService = $offerService;
    }

    /**
     * Get all offers available for the authenticated user.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse Returns a collection of offers
     */
    public function index(Request $request)
    {
        $result = $this->offerService->index($request->user());

        return $this->ok('Offers', [
            'offers' => OfferResource::collection($result['offers'])
        ]);

    }

}
