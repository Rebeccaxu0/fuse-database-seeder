<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class UploadCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $code = Str::of($value)->upper()->remove(' ');
        $response = Http::acceptJson()
            ->get('https://api.fusestudio.net/validate/' . urlencode($code));
        return $response->ok()
            && $response->json()['status'] == 'ready';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Sorry, that upload code doesn't work. It may contain a typo, or has already been claimed.");
    }
}
