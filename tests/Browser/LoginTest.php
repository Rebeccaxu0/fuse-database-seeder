<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::factory()->make();
            $browser->visit('/login')->type('email', $user->email)
                ->type('password', 'password123')
                ->press('LOG IN')
                ->assertGuest();;
        });
    }
}
