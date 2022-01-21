<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LocaleSwitcher extends Component
{
    public $activeLocale = '';
    public $locales;

    public function mount()
    {
        $this->activeLocale = App::currentLocale();
        $this->locales = config('app.available_locales');
    }

    public function setLocale()
    {
        if (Auth::check()) {
            Auth::user()->language = $this->activeLocale;
            Auth::user()->save();
        }
        Session::put('locale', $this->activeLocale);
        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.locale-switcher');
    }
}
