<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameInvitation extends Model
{
    use HasFactory;

    protected static function booting()
    {
        parent::booting();

        static::creating(fn(GameInvitation $invitation) => $invitation->email = strtolower($invitation->email));
    }

    protected $fillable = [
        'game_id',
        'email',
    ];

    protected $visible = [
        'game_id',
        'email',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function userExists(): bool
    {
        return User::where('email', $this->email)->exists();
    }

    /**
     * Refuse the invitation
     *
     * @return void
     */
    public function refuse(): void
    {
        $this->delete();
    }

    /**
     * Accept the invitation and join the game.
     *
     * @return boolean
     */
    public function accept(): bool
    {
        $user = User::where('email', $this->email)->first();

        if ($user === null) return false;

        $this->game->players()->attach($user->id);

        $this->delete();

        return true;
    }
}
