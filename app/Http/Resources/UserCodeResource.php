<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * JSON resource for user code representation.
 * Formats user code data with relationships according to JSON:API specifications.
 */
class UserCodeResource extends JsonResource
{
    /**
     * Transform the user code into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'codes',
            'id' => (string) $this->id,
            'attributes' => [
                'code' => $this->code,
                'status' => $this->status,
                'redeemedAt' => $this->redeemed_at?->toIso8601String(),
                'createdAt' => $this->created_at->toIso8601String(),
            ],
            'meta' => [
                'isRedeemed' => $this->status === 'redeemed',
            ],
            'relationships' => [
                'user' => [
                    'data' => [
                        'type' => 'users',
                        'id' => (string) $this->user_id,
                    ],
                ],
                'offer' => [
                    'data' => [
                        'type' => 'offers',
                        'id' => (string) $this->offer_id,
                        'attributes' => [
                            'title' => $this->offer->title,
                            'description' => $this->offer->description,
                            'discount' => $this->offer->discount,
                        ],
                    ],
                ],
            ],
        ];

    }
}
