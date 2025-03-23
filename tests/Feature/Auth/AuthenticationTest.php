<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

// Test de registro
it('can register a new user', function () {
  $response = $this->postJson('/api/register', [
    'email' => 'test@example.com',
    'password' => 'password123',
  ]);

  $response->assertStatus(200)
    ->assertJsonStructure([
      'message',
      'data' => [
        'user' => [
          'type',
          'id',
          'attributes' => [
            'email',
          ],
        ],
      ],
    ]);

  $this->assertDatabaseHas('users', [
    'email' => 'test@example.com',
  ]);
});

it('cannot register with invalid data', function () {
  $response = $this->postJson('/api/register', [
    'email' => 'invalid-email',
    'password' => '123',
  ]);

  $response->assertStatus(422)
    ->assertJsonValidationErrors(['email', 'password']);
});

it('can login with correct credentials', function () {
  $user = User::factory()->create([
    'email' => 'test@example.com',
    'password' => Hash::make('password123'),
  ]);

  $response = $this->postJson('/api/login', [
    'email' => 'test@example.com',
    'password' => 'password123',
  ]);

  $response->assertStatus(200)
    ->assertJsonStructure([
      'message',
      'data' => [
        'user' => [
          'type',
          'id',
          'attributes' => [
            'email',
          ],
        ],
        'token' => [
          'type',
          'attributes' => [
            'token',
          ],
        ],
      ],
    ]);
});

it('cannot login with incorrect credentials', function () {
  $user = User::factory()->create([
    'email' => 'test@example.com',
    'password' => Hash::make('password123'),
  ]);

  $response = $this->postJson('/api/login', [
    'email' => 'test@example.com',
    'password' => 'wrong-password',
  ]);

  $response->assertStatus(401)
    ->assertJson(['message' => 'Invalid credentials']);
});

it('can logout an authenticated user', function () {
  $user = User::factory()->create();
  Sanctum::actingAs($user);

  $response = $this->postJson('/api/logout');

  $response->assertStatus(200)
    ->assertJson(['message' => 'Logged out successfully']);

  $this->assertCount(0, $user->tokens);
});

it('cannot logout without authentication', function () {
  $response = $this->postJson('/api/logout');

  $response->assertStatus(401)
    ->assertJson(['message' => 'Unauthenticated.']);
});