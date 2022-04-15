<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

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
        // TODO: call out to FUSE mobile Uploader API to validate code.
        return true;
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
