<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Player extends Pivot
{
    protected $fillable = [
        'user_id',
        'game_id',
    ];
}
