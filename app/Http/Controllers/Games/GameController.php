<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function play(Game $game)
    {
        if (auth()->user()->can('view', $game))
            return Inertia::render('PlaySession', [
                'gameId' => $game->id,
                'tokens' => $game->tokens()->get()->toArray()
            ]);

        abort(403);
    }
}
