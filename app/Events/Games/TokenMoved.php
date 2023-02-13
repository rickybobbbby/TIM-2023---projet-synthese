<?php

namespace App\Events\Games;

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
    public function __construct(protected $game, protected $token, protected $x, protected $y)
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
        return new PrivateChannel('Game.' . $this->game);
    }

    public function broadcastWith(): array
    {
        return ['game' => $this->game, 'token' => $this->token, 'x' => $this->x, 'y' => $this->y];
    }

    public function broadcastAs(): string
    {
        return 'token.moved';
    }
}
