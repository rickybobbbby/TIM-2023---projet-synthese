<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
    ];

    protected $visible = [
        'id',
        'name',
        'owner_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class);
    }

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'players')
            ->using(Player::class)
            ->as('player')
            ->withPivot(['id']);
    }

    public function invites(): HasMany
    {
        return $this->hasMany(GameInvitation::class);
    }

    public function hasUserJoined(User $user): bool
    {
        return $this->players()->where('user_id', $user->id)->exists();
    }

}
