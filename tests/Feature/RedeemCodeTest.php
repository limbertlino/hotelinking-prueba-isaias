<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Code;
use App\Enums\CodeStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RedeemCodeTest extends TestCase
{
  use RefreshDatabase;


  public function test_user_can_redeem_a_code()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $code = Code::factory()->create([
      'user_id' => $user->id,
      'status' => CodeStatus::Active,
    ]);

    $response = $this->patchJson("/api/codes/{$code->id}/redeem");

    $response->assertStatus(200)
      ->assertJson([
        'message' => 'Code redeemed successfully',
      ]);

    $this->assertDatabaseHas('codes', [
      'id' => $code->id,
      'status' => CodeStatus::Redeemed,
      'redeemed_at' => now(),
    ]);
  }

  public function test_user_cannot_redeem_an_already_redeemed_code()
  {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $code = Code::factory()->create([
      'user_id' => $user->id,
      'status' => CodeStatus::Redeemed,
      'redeemed_at' => now(),
    ]);

    $response = $this->patchJson("/api/codes/{$code->id}/redeem");

    $response->assertStatus(400)
      ->assertJson([
        'message' => 'This code has already been redeemed.',
      ]);
  }
}