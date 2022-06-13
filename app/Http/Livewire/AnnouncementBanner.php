<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AnnouncementBanner extends Component
{
    public $announcements = [];

    public function mount(User $user)
    {
        if (! $user->isStudent()) {
            $unread_announcement_ids = Cache::tags(['announcements'])
                ->remember(
                "u{$user->id}_unseen_announcement_ids", 3600, function () use ($user) {
                    $now = new DateTime();
                    return Announcement::where('start_at', '<=', $now->format('Y-m-d H:i:s'))
                        ->where('end_at', '>=', $now->format('Y-m-d H:i:s'))
                        ->whereNotIn('id', function ($query) use ($user) {
                            $query->select('announcement_id')
                                  ->from('announcement_seen')
                                  ->where('user_id', '=', $user->id);
                        })
                        ->pluck('id');
                }
            );
            if ($unread_announcement_ids->count()) {
                $this->announcements = Announcement::whereIn('id', $unread_announcement_ids)->get();
            }
        }
    }

    public function dismiss(int $announcementId)
    {
        $user = Auth::user();
        $announcement = Announcement::find($announcementId);
        $announcement->readers()->save(Auth::user());
        $this->announcements = $this->announcements->whereNotIn('id', $announcementId);
        Cache::tags(['announcements'])->forget("u{$user->id}_unseen_announcement_ids");
    }

    public function render()
    {
        return view('livewire.announcement-banner');
    }
}
