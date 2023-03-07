<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'filename',
        'width',
        'height',
        'longitude',
        'latitude',
    ];

    protected $appends = [
        'url',
    ];

    protected static function booting()
    {
        parent::booting();

        static::deleted(
            fn(Asset $asset) => Storage::disk('game_assets')
                ->delete("$asset->game_id/assets/$asset->filename")
        );

        static::updating(function (Asset $asset) {
            // Cleanup the previous file if a new one was uploaded
            if ($asset->filename !== ($origFilename = $asset->getOriginal('filename'))) {
                Storage::disk('game_assets')
                    ->delete("$asset->game_id/assets/$origFilename");
            }
        });
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::disk('game_assets')
                ->url("$this->game_id/assets/$this->filename")
        );
    }
}
