<?php

namespace App\Rules;

use App\Models\Studio;
use Illuminate\Contracts\Validation\InvokableRule;

class NoExistingMembers implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $studio = Studio::where('join_code', $value)->first();
        if ($studio && auth()->user() && auth()->user()->deFactoStudios()->contains($studio)) {
            $fail(__('You are already a member of :studio', ['studio' => $studio->name]));
        }
    }
}
