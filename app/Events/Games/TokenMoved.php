<?php

namespace App\Events\Games;

use App\Models\Game;
use App\Models\Token;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class TokenMoved implements ShouldBroadcastNow
{
    use InteractsWithSockets, InteractsWithBroadcasting;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(protected Game $game, protected Token $token, protected $longitude, protected $latitude)
    {
        $this->broadcastVia('pusher');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Game.' . $this->game->id);
    }

    public function broadcastWith(): array
    {
        return [
            'gameId' => $this->game->id,
            'tokenId' => $this->token->id,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude
        ];
    }

    public function broadcastAs(): string
    {
        return 'token.moved';
    }
}
