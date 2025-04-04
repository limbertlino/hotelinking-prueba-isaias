<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * JSON resource for User model representation.
 * Formats basic user data according to JSON:API specifications.
 */
class UserResource extends JsonResource
{
    /**
     * Transform the user data into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'users',
            'id' => (string) $this->id,
            'attributes' => [
                'email' => $this->email,
            ],

        ];
    }


}
