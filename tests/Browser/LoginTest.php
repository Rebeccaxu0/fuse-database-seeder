<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    
    public function testSuccessfulLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::factory()->state([
                'password' => '$2y$10$YmNDcP/csWCz2wFVe4.O.e2/4tlug3VYFaufHRCWb8C7KkEXk0ixa',
            ])->create();
            $browser->visit('/')
                ->type('name', $user->name)
                ->type('password', 'fusefuse')
                ->press('LOG IN')
                ->assertAuthenticated();
            $user->delete;
        });
    }

    public function testFailedLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = \App\Models\User::factory()->state([
                'password' => '$2y$10$YmNDcP/csWCz2wFVe4.O.e2/4tlug3VYFaufHRCWb8C7KkEXk0ixa',
            ])->create();
            $browser->visit('/')
                ->type('name', $user->name)
                ->type('password', 'wrong')
                ->press('LOG IN')
                ->assertGuest()
                ->assertSee('Whoops! Something went wrong.');
        });
    }


}
