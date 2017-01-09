<?php

namespace Medlib\Tests\TestForms;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class SettingsAdminTest extends TestCase
{

    /**
     * Setting a new password for current user login
     */
    public function testChangeUserPassword()
    {
        /**
        $user = Factory::create(User::class);

        Auth::login($user);

        $this->visit('/settings/admin')
            ->type('secret1983', 'password_current')
            ->type('secret1982', 'password_new')
            ->type('secret1982', 'password_confirm')
            ->press('Mettre à jour')
            ->seeInDatabase('users', ['password' => 'secret1982']);
        **/
    }

    /**
     * Deleting the current user login
     */
    public function testDeletingUser()
    {
        /**
        $this->visit('/settings/admin');
        $this->type('eldorplus@gmail.com', 'email');
        $this->type('Lusquain01', 'password');
        $this->press('Supprimer');
        $this->seePageIs('/settings/eldorplus/delete');
        **/
    }
}
