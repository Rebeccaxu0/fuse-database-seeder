<?php

namespace App\Models;

class EthnicityOptions
{
    public static function full()
    {
       return [
          'african_american'  => __('African American'),
          'asian'  => __('Asian'),
          'hispanic_latino'  => __('Hispanic / Latino'),
          'middle_eastern'  => __('Middle Eastern'),
          'indigenous_american'  => __('Native American'),
          'pacific_islander'  => __('Pacific Islander'),
          'caucasian'  => __('White'),
          'multiracial'  => __('Multiracial'),
          'rather_not_say'  => __('Rather not say'),
        ];
    }
}
