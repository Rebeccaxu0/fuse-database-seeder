<?php

namespace App\Events;

use App\Models\Studio;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudioDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Studio $studio;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Studio $studio)
    {
        $this->studio = $studio;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
