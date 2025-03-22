<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $isRedeemed = fake()->boolean(20);

        return [
            'user_id' => User::factory(),
            'offer_id' => Offer::factory(),
            'code' => fake()->unique()->regexify('[A-Z0-9]{7}'),
            'status' => $isRedeemed ? 'Redeemed' : 'Active',
            'redeemed_at' => $isRedeemed ? fake()->dateTimeThisYear() : null
        ];
    }
}
