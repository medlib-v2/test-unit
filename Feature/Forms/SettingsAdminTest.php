<?php

namespace Tests\Feature\TestForms;

use Medlib\Models\User;
use Tests\BrowserKitTestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsAdminTest extends BrowserKitTestCase
{
    /**
     * Setting a new password for current user login
     */
    public function testChangeUserPassword()
    {
        $user = Factory::create(User::class);

        $this->postAsUser(route('profile.edit.admin'), [
            'password_current' => 'secret1983',
            'password_new' => 'secret1982',
            'password_confirm' => 'secret1982'
        ], $user)->seeStatusCode(200);

        $user = User::find($user->id);
        $this->assertTrue(Hash::check('secret1982', $user->getOriginal('password')));
    }

    /**
     * Deleting the current user login
     */
    public function testDeletingUser()
    {
        $user = Factory::create(User::class);

        Auth::login($user);

        $this->deleteAsUser(route('profile.delete.username', ['username' => $user->getUsername()]), [
            'email' => $user->getEmail(),
            'password' => 'secret1983'
        ], $user)
            ->seeStatusCode(422)
            ->seeJson([
                'recaptcha_response' => ['The I am not a robot field is required.']
            ]);//->notSeeInDatabase('users', ['id' => $user->id]);

        $this->markTestIncomplete();
    }

    public function testUserPreferences()
    {
        $this->markTestIncomplete();
        /**
        $user =  Factory::create(User::class);
        $this->assertNull($user->getPreference('foo'));
        $user->setPreference('foo', 'bar');
        $this->assertEquals('bar', $user->getPreference('foo'));
        $user->deletePreference('foo');
        $this->assertNull($user->getPreference('foo'));
        **/
    }
}
