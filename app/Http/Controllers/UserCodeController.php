<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCodeResource;
use App\Models\Code;
use App\Services\UserCodeService;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

/**
 * Controller for managing user codes (viewing and redeeming).
 */
class UserCodeController extends Controller
{
    use ApiResponses;

    protected $userCodeService;

    public function __construct(UserCodeService $userCodeService)
    {
        $this->userCodeService = $userCodeService;
    }

    /**
     * Get all codes belonging to the authenticated user.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $result = $this->userCodeService->getUserCodes($user);

        return $this->ok('User codes', [
            'codes' => UserCodeResource::collection($result['codes']),
        ]);
    }

    /**
     * Redeem a specific code.
     * 
     * @param Request $request
     * @param Code $code The code to redeem
     * @return \Illuminate\Http\JsonResponse
     */
    public function redeem(Request $request, Code $code)
    {
        $user = $request->user();
        $result = $this->userCodeService->redeemCode($user, $code);

        if (!$result) {
            return $this->error('This code has already been redeemed.', 400);
        }

        return $this->ok('Code redeemed successfully', [
            'code' => new UserCodeResource($result['code'])
        ]);
    }
}
