<?php

namespace App\Events;

use App\Models\School;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SchoolSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public School $school;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(School $school)
    {
        $this->school = $school;
    }
}
