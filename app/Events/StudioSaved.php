<?php

namespace App\Events;

use App\Models\Studio;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StudioSaved
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
}
