<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;

class LoginTest extends TestCase {

    /**
     * @test if the input email is empty
     * @return void
     */
    public function testEmptyEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => '', 'password' => 'secret1983'])
            ->assertSessionHasErrors(['email']);
    }

    /**
     * @test if your email address is not valid
     * @return void
     */
    public function testInvalidEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jondoe.com', 'password' => 'secret1983'])
            ->assertSessionHasErrors(['email']);
    }

    /**
     * @test if the input password is empty
     * @return void
     */
    public function testEmptyPasswordShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jon@Doe.com', 'password' => ''])
            ->assertSessionHasErrors(['password']);
    }

    /**
     * @test if your credentials return an error
     * @return void
     */
    public function testLoginWithWrongCredentialsShowsError() {

        $currentUser = Factory::create(User::class);

        $this->visit('/')
            ->submitForm('Connexion', ['email' => $currentUser->getEmail(), 'password' => 'heheheh'])
            ->see("Nous avons été incapables de vous connecter. Merci vérifier vos informations d'identification et réessayez à nouveau.");
    }

    /**
     * @test if you are no connected you are redirected to login page
     * @return void
     */
    public function testNoLoggedRedirectLoginPage() {
        $this->app->instance('middleware.disable', false);
        $this->call('GET', 'dashboard');
        $this->assertRedirectedToRoute('auth.login');
    }

}