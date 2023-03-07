<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'user_id',
        'name',
        'longitude',
        'latitude',
        'filename',
    ];

    protected $appends = [
        'url',
    ];

    protected static function booting()
    {
        parent::booting();

        static::deleted(
            fn(Token $token) => Storage::disk('game_assets')
                ->delete("$token->game_id/tokens/$token->filename")
        );

        static::updating(function (Token $token) {
            // Cleanup the previous file if a new one was uploaded
            if ($token->filename !== ($origFilename = $token->getOriginal('filename'))) {
                Storage::disk('game_assets')
                    ->delete("$token->game_id/tokens/$origFilename");
            }
        });
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::disk('game_assets')
                ->url("$this->game_id/tokens/$this->filename")
        );
    }
}
