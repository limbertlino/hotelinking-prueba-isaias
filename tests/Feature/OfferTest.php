<?php

namespace Tests\Feature;

use App\Models\Offer;
use App\Models\User;
use App\Models\Code;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OfferTest extends TestCase
{
  use RefreshDatabase;

  public function test_user_can_view_offers()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $offers = Offer::factory()->count(3)->create();

    $response = $this->getJson('/api/users/offers');

    $response->assertStatus(200)
      ->assertJsonStructure([
        'message',
        'data' => [
          'offers' => [
            '*' => [
              'type',
              'id',
              'attributes' => [
                'title',
                'description',
                'discount',
                'createdAt',
              ],
              'meta' => [
                'isClaimed',
              ],
            ],
          ],
        ],
      ]);
  }


  public function test_user_can_claim_an_offer()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $offer = Offer::factory()->create();

    $response = $this->postJson("/api/offers/{$offer->id}/claim", []);

    $response->assertStatus(200)
      ->assertJsonStructure([
        'message',
        'data' => [
          'code' => [
            'type',
            'id',
            'attributes' => [
              'code',
              'status',
              'createdAt',
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
        'status',
      ]);

    $this->assertDatabaseHas('codes', [
      'user_id' => $user->id,
      'offer_id' => $offer->id,
    ]);
  }

  public function test_user_cannot_claim_an_already_claimed_offer()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $offer = Offer::factory()->create();
    Code::factory()->create([
      'user_id' => $user->id,
      'offer_id' => $offer->id,
    ]);

    $response = $this->postJson("/api/offers/{$offer->id}/claim", []);

    $response->assertStatus(400)
      ->assertJson([
        'message' => 'You have already claimed this offer.',
      ]);
  }
}