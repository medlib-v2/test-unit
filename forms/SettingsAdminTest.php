<?php

namespace Medlib\Tests\TestForms;

use Medlib\Tests\TestCase;

class SettingsAdminTest extends TestCase
{

    /**
     * Setting a new password for current user login
     */
    public function testChangeUserPassword()
    {
        /**
        $this->seePageIs('/settings/admin');
        $this->type('secret1983', 'password_current');
        $this->type('secret1982', 'password_new');
        $this->type('secret1982', 'password_confirm');
        $this->press('Mettre à jour');
        $this->seeInDatabase('users', ['password' => 'secret1982']);
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