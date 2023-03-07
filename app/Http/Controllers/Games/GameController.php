<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\GameUpdateRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GameController extends Controller
{
    public function play(Game $game)
    {
        if (auth()->user()->can('view', $game))
            return Inertia::render('Game/PlaySession', [
                'game' => $game->toArray(),
                'tokens' => $game->tokens()->get()->toArray(),
                'players' => $game->players()->get()->toArray(),
                'asset' => $game->assets()->latest()->first()?->toArray(),
            ]);

        abort(403);
    }

    public function update(GameUpdateRequest $request, Game $game)
    {
        $game->update($request->safe()->toArray());

        return $this->play($game);
    }
}
