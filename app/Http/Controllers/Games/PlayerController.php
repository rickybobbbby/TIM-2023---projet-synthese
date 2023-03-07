<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\GameInviteRequest;
use App\Models\Game;
use App\Models\GameInvitation;
use App\Models\Player;
use App\Models\Token;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function invite(GameInviteRequest $request, Game $game)
    {
        $game->invites()->create(['email' => $request->validated('email')]);

        return redirect()->route('game', compact('game'));
    }

    public function kick(Game $game, Player $player)
    {
        // Cannot kick yourself
        if ($player->game_id !== $game->id)
            abort(401);

        // Unassign all tokens from that user from that game
        Token::where([
            'game_id' => $game->id,
            'user_id' => $player->user_id
        ])->update(['user_id' => null]);

        // Delete the <User> <=> <Game> Association
        $player->delete();

        return redirect()->route('game', compact('game'));
    }
}
