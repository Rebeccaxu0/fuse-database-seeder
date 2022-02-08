<?php

namespace App\Models;

class GenderOptions
{
    public static function restricted()
    {
       return [
            'F'  => __('Girl'),
            'M'  => __('Boy'),
            'U'  => __('Rather not say'),
        ];
    }

    public static function full()
    {
       return [
            'F'  => __('Female'),
            'M'  => __('Male'),
            'NB' => __('Non-binary'),
            'U'  => __('Rather not say'),
        ];
    }
}
