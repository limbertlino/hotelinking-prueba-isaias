<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
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
