<?php

namespace App\Http\Controllers\Games;

use App\Events\Games\TokenMoved;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\TokenStoreRequest;
use App\Http\Requests\Game\TokenUpdateRequest;
use App\Models\Game;
use App\Models\Token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function move(Request $request, Game $game, Token $token)
    {
        if (!$request->user()->can('view', $game) || !$request->user()->can('update', $token)) {
            abort(403);
        }

        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');

        $token->update(compact('longitude', 'latitude'));

        broadcast(new TokenMoved($game, $token, $longitude, $latitude))->toOthers();
    }

    public function create(TokenStoreRequest $request, Game $game)
    {
        $game->tokens()->create(
            array_filter([
                ...$request->safe()->except('file'),
                'filename' => $request->safe()->has('file')
                    ? basename($request->file('file')->storePublicly("games/$game->id/tokens", 'game_assets'))
                    : null
            ])
        );

        return redirect()->route('game', compact('game'));
    }

    public function update(TokenUpdateRequest $request, Game $game, Token $token)
    {
        $token->update(
            array_filter([
                ...$request->safe()->except('file'),
                'filename' => $request->safe()->has('file')
                    ? basename($request->file('file')->storePublicly("games/$game->id/tokens", 'game_assets'))
                    : null
            ])
        );

        return redirect()->route('game', compact('game'));
    }
}
