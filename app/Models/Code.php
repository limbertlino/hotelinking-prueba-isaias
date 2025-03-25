<?php

namespace App\Models;

use App\Enums\CodeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents a redeemable code associated with offers and users.
 * 
 * Tracks code status (active/redeemed) and redemption timestamp.
 */
class Code extends Model
{
    /** @use HasFactory<\Database\Factories\CodeFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'status',
        'user_id',
        'offer_id',
        'redeemed_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        //
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => CodeStatus::class,
            'redeemed_at' => 'datetime'
        ];
    }


    /**
     * Relationship: User who owns this code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Relationship: Offer associated with this code.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Offer>
     */
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

}
