<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Represents a promotional offer with discount details.
 * Manages offer-codes relationship and user claim status.
 */
class Offer extends Model
{
    /** @use HasFactory<\Database\Factories\OfferFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'discount'
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
            //
        ];
    }

    /**
     * Relationship: All codes associated with this offer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Code>
     */
    public function codes()
    {
        return $this->hasMany(Code::class);
    }



    /**
     * Check if the offer has been claimed by a specific user.
     *
     * @param User $user
     * @return bool
     */
    public function isClaimedByUser(User $user)
    {
        return $this->codes()->where('user_id', $user->id)->exists();
    }


}
