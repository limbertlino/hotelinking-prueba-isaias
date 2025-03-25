<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * JSON resource for authentication token representation.
 * Formats token data according to JSON:API specifications.
 */
class TokenResource extends JsonResource
{

    /**
     * Transform the token into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'tokens',
            'attributes' => [
                'token' => $this->resource
            ]
        ];
    }
}
