<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserCodesTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_view_their_codes()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $codes = Code::factory()->count(3)->create(['user_id' => $user->id]);

    $response = $this->getJson('/api/users/codes');

    $response->assertStatus(200)
      ->assertJsonStructure([
        'message',
        'data' => [
          'codes' => [
            '*' => [
              'type',
              'id',
              'attributes' => [
                'code',
                'status',
                'redeemedAt',
                'createdAt',
              ],
              'meta' => [
                'isRedeemed',
              ],
              'relationships' => [
                'user' => [
                  'data' => [
                    'type',
                    'id',
                  ],
                ],
                'offer' => [
                  'data' => [
                    'type',
                    'id',
                  ],
                ],
              ],
            ],
          ],
        ],
        'status',
      ]);
  }
}