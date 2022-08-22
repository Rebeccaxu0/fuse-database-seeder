<?php

namespace App\Http\Controllers;

use App\Models\ChallengeVersion;
use App\Models\HelpArticle;
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
     * @return \Illuminate\Http\Response
     */
    public function replaceVideoTags()
    {
        Gate::allowIf(Auth::user()->id == 1);

        $cvs = ChallengeVersion::all();

        $oldVideoRegexes = [];
        $oldVideoRegexes[] = <<<REGEX
|<a\s+href="#"\s*>\s*video\s*</a>|i
REGEX;
        $oldVideoRegexes[] = <<<REGEX
|<a class="icon icon-video-link" href="#">video</a>|i
REGEX;
        $oldVideoRegexes[] = <<<REGEX
|<a\s+class="icon\s+icon-video-link"\s+href="#"\s*>\s*video\s*</span>|i
REGEX;
        $oldVideoRegexes[] = <<<REGEX
|<a\s+class=['"]icon\s+icon-video-link['"]\s+href=['"]#['"]\s*>\s*video\s*</a>|i
REGEX;
        $oldVideoRegexes[] = <<<REGEX
|<a\s+href=['"]#['"]\s+class=['"]icon\s+icon-video-link['"]\s*>\s*video\s*</a>|i
REGEX;
        // $newVideo = '<a href="#"><x-icon icon="video" class="inline" /></a>';
//         $oldVideo = <<<REGEX
// /<x-icon icon="video" class="inline" \/>/
// REGEX;
        $newVideo = '<x-icon icon="video" class="inline" style="color:#0284C7" />';
        foreach ($cvs as $challengeVersion) {
            foreach ($challengeVersion->levels as $level) {
                $alltranslations = $originalxlation = $level->getTranslations();
                foreach ($alltranslations as $attr => $translations) {
                    foreach ($translations as $language => $value) {
                        $target = $value;
                        foreach ($oldVideoRegexes as $oldVideo) {
                            $target = Str::of($target)->replaceMatches($oldVideo, $newVideo);
                        }
                        $alltranslations[$attr][$language] = $target;
                    }
                    $level->setTranslations($attr, $alltranslations[$attr]);
                }
                $level->save();
            }
        }
        session()->flash('flash.banner', 'i did it');
        return view('admin.seekrit');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function replaceHelpPopupLinks()
    {
        Gate::allowIf(Auth::user()->id == 1);

        $cvs = ChallengeVersion::all();

        foreach ($cvs as $challengeVersion) {
            foreach ($challengeVersion->levels as $level) {
                $alltranslations = $level->getTranslations();
                foreach ($alltranslations as $attr => $translations) {
                    foreach ($translations as $language => $value) {
                        $field = $value;
                        if (preg_match_all('|<a href="/popup_lightbox/nojs/(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a href="/popup_lightbox/nojs/' . $url_fragment . '" target="_blank"  class="ctools-use-modal ctools-modal-FUSE-default">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a href="/popup_lightbox/nojs/(.+)" target="_blank"  class="ctools-use-modal ctools-modal-FUSE-default">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a href="/popup_lightbox/nojs/' . $url_fragment . '" target="_blank"  class="ctools-use-modal ctools-modal-FUSE-default">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a target="_blank" class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a target="_blank" class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/' . $url_fragment . '">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a href="/popup_lightbox/nojs/(.+)" target="_blank" class="ctools-use-modal ctools-modal-FUSE-default">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a href="/popup_lightbox/nojs/' . $url_fragment . '" target="_blank" class="ctools-use-modal ctools-modal-FUSE-default">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a href="/popup_lightbox/nojs/(.+)" class="ctools-use-modal ctools-modal-FUSE-default">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a href="/popup_lightbox/nojs/' . $url_fragment . '" class="ctools-use-modal ctools-modal-FUSE-default">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="fuseicon ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="fuseicon ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/' . $url_fragment . '">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/' . $url_fragment . '">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/' . $url_fragment . '">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/(.+)" target="_blank">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/' . $url_fragment . '" target="_blank">' . $matches[2][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[2][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/(.+)" title="(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="ctools-use-modal ctools-modal-FUSE-default" href="/popup_lightbox/nojs/' . $url_fragment . '" title="' . $matches[2][$k] . '">' . $matches[3][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[3][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                        if (preg_match_all('|<a class="ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/(.+)" title="(.+)">(.+)</a>|U', $value, $matches)) {
                            foreach ($matches[1] as $k => $url_fragment) {
                                $url_fragment = urldecode($url_fragment);
                                $article = HelpArticle::where('d7_alias', 'like', "%popup/{$url_fragment}%")->first();
                                if ($article) {
                                    $search = '<a class="ctools-use-modal ctools-modal-FUSE-complete-form-style" href="/popup_lightbox/nojs/' . $url_fragment . '" title="' . $matches[2][$k] . '">' . $matches[3][$k] . '</a>';
                                    $replace = "<livewire:help-modal helpArticleId=\"{$article->id}\" linkText=\"{$matches[3][$k]}\" />";
                                    $field = str_replace($search, $replace, $field);
                                }
                            }
                            $alltranslations[$attr][$language] = $field;
                        }
                    }
                    $level->setTranslations($attr, $alltranslations[$attr]);
                }
                $level->save();
            }
        }
        session()->flash('flash.banner', 'i did the other one for you');
        return view('admin.seekrit');
    }
}
