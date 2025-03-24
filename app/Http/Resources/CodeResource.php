<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
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
                'createdAt' => $this->created_at->toIso8601String(),
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
                    ],
                ],
            ],
        ];
    }
}
