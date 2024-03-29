<?php

namespace Tests\Browser;

use App\Models\Package;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCRUDTest extends DuskTestCase
{

    public function testAdminCreatePackage()
    {
        $this->browse(function (Browser $browser) {
            $pkgtest = Package::factory()->state([
                'name' => 'Test Package',
            ])->create();
            $browser->loginAs(User::find(1)) //needs to be an admin user
                    ->visit('/admin/packages')
                    ->press('Add package')
                    ->assertPathIs()
                    ->type('name' -> $pkgtest->name)
                    //body
                    //select challenges
                    ->press('Save')
                    ->visit('/admin/packages');
                    //->assertSee(package title)
            $user->delete;
        });
    }

    public function testAdminUpdatePackage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) //needs to be an admin user
                    ->visit('/admin/packages')
                    ->press('Edit')
                    //unselect challenge
                    ->press('Save')
                    ->visit('/admin/packages');
                    //->assertDontSee(challenge title)
            $user->delete;
        });
    }


    public function testAdminDeletePackage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) //needs to be an admin user
                    ->visit('/admin/packages')
                    ->press('Edit')
                    //title
                    //body
                    //select challenges
                    ->press('Delete')
                    ->visit('/admin/packages');
                    //->assertDontSee(package title)
            $user->delete;
        });
    }


}
