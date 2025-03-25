<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCodeResource;
use App\Models\Offer;
use App\Services\ClaimOfferService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

/**
 * Handles offer claiming functionality.
 */
class ClaimOfferController extends Controller
{
    use ApiResponses;

    protected $claimOfferService;

    public function __construct(ClaimOfferService $claimOfferService)
    {
        $this->claimOfferService = $claimOfferService;
    }


    /**
     * Claims an offer for the authenticated user.
     * 
     * @param Request $request
     * @param Offer $offer The offer to claim
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Offer $offer)
    {
        $user = $request->user();

        if ($offer->isClaimedByUser($user)) {
            return $this->error('You have already claimed this offer.', 400);
        }

        $result = $this->claimOfferService->claimOffer($user, $offer);

        if (!$result) {
            return $this->error('Failed to claim the offer. Please try again later.', 500);
        }

        return $this->ok('Offer claimed successfully', [
            'code' => new UserCodeResource($result['code'])
        ]);

    }

}
