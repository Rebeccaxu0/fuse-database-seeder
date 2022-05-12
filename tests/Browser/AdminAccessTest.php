<?php

namespace Tests\Browser;

use App\Models\Role;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminAccessTest extends DuskTestCase
{

    public function testAdminAccess()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->state([
                'password' => '$2y$10$YmNDcP/csWCz2wFVe4.O.e2/4tlug3VYFaufHRCWb8C7KkEXk0ixa',
            ])->create();
            $admin_role = Role::where('name', 'FUSE Administrator')->first();
            $admin_role->$user;
            $browser->visit('/')
                ->type('name', $user->name)
                ->type('password', 'password')
                ->press('Sign In')
                ->assertAuthenticated()
                ->visit('/admin/packages')
                ->assertSee('Packages');
            $user->delete;
        });
    }

    public function testNotAdmin()
    {
        $this->browse(function (Browser $browser) {
            $user = User::factory()->state([
                'password' => '$2y$10$YmNDcP/csWCz2wFVe4.O.e2/4tlug3VYFaufHRCWb8C7KkEXk0ixa',
            ])->create();
            $student_role = Role::where('name', 'Student')->first();
            $student_role->$user;
            $browser->visit('/')
                ->type('name', $user->name)
                ->type('password', 'password')
                ->press('Sign In')
                ->assertAuthenticated()
                ->visit('/admin/packages')
                ->assertSee('403');
            $user->delete;
        });
    }


}
