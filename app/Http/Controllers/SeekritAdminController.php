<?php

namespace App\Http\Controllers;

use App\Models\ChallengeVersion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class SeekritAdminController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function replaceVideoTags()
    {
        Gate::allowIf(Auth::user()->id == 1);

        $cvs = ChallengeVersion::all();

        $oldVideo = <<<REGEX
/<a\s+class=['"]icon\s+icon-video-link['"]\s+href=['"]#['"]\s*>\s*video\s*<\/a>/
REGEX;
        $newVideo = '<a href="#"><x-icon icon="video" class="inline" /></a>';
        foreach ($cvs as $challengeVersion) {
            foreach ($challengeVersion->levels as $level) {
                $alltranslations = $originalxlation = $level->getTranslations();
                // dd($alltranslations);
                foreach ($alltranslations as $attr => $translations) {
                    foreach ($translations as $language => $value) {
                        $alltranslations[$attr][$language]
                            = Str::of($value)->replaceMatches($oldVideo, $newVideo);
                    }
                    $level->setTranslations($attr, $alltranslations[$attr]);
                }
                $level->save();
            }
        }
        session()->flash('flash.banner', 'i did it');
        return view('admin.seekrit');
    }
}
