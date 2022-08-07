<?php

namespace App\Listeners;

use App\Events\SchoolDeleting;
use App\Events\SchoolSaved;
use App\Events\StudioDeleting;
use App\Events\StudioSaved;

class StudioUpdateSubscriber
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handleSchool($event)
    {
      $event->school->clearDeFactoStudiosCaches();
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handleStudio($event)
    {
        $event->studio->clearDeFactoStudiosCaches();
    }

    public function subscribe($events)
    {
        return [
            SchoolDeleting::class => 'handleSchool',
            SchoolSaved::class => 'handleSchool',
            StudioDeleting::class => 'handleStudio',
            StudioSaved::class => 'handleStudio',
        ];
    }
}
