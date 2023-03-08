<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\AssetStoreRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function store(AssetStoreRequest $request, Game $game)
    {
        list($w, $h) = getimagesize($request->file('file')->path());

        $game->assets()->create([
            ...$request->safe()->except('file'),
            'width' => $w,
            'height' => $h,
            'filename' => basename($request->file('file')->storePublicly("$game->id/assets", 'game_assets'))
        ]);

        return redirect()->route('game', compact('game'));
    }
}
