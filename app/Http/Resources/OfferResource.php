<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * JSON resource for Offer model representation.
 * Formats offer data according to JSON:API specifications.
 */
class OfferResource extends JsonResource
{
    /**
     * Transform the offer into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'offers',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'discount' => $this->discount,
                'createdAt' => $this->created_at->toIso8601String(),
            ],
            'meta' => [
                'isClaimed' => $this->isClaimedByUser($request->user())
            ]
        ];
    }
}
