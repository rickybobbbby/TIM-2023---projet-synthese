<?php

namespace App\Http\Controllers\Games;

use App\Events\Games\TokenMoved;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function move(Request $request, int $game, int $token)
    {
        broadcast(new TokenMoved($game, $token, $request->input('x'), $request->input('y')))->toOthers();
    }
}
