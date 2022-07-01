<?php

namespace App\Actions\Fortify;

use App\Models\Studio;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $studioCode = Str::of($input['studioCode'])->replaceMatches('/[ ]++/', ' ')->trim()->lower();
        $studio = Studio::where('join_code', $studioCode)->first();
        if ($studio->require_email) {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'fullName' => ['required', 'string', 'max:255'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
        } else {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'fullName' => ['required', 'string', 'max:255'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
        }

        $userValues = [
            'name' => $input['name'],
            'full_name' => $input['fullName'],
            'active_studio' => $studio->id,
            'password' => Hash::make($input['password']),
        ];
        if ($studio->require_email) {
            $userValues['email'] = $input['email'];
        }
        $newuser = User::create($userValues);
        $newuser->studios()->attach($studio->id);
        return $newuser;
    }
}
