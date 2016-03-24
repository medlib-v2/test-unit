<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

class LoginTest extends TestCase {


    public function testEmptyEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => '', 'password' => 'secret1983'])
            ->assertSessionHasErrors(['email']);
    }

    public function testInvalidEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jondoe.com', 'password' => 'secret1983'])
            ->assertSessionHasErrors(['email']);
    }

    public function testEmptyPasswordShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jon@Doe.com', 'password' => ''])
            ->assertSessionHasErrors(['password']);
    }

    public function testLoginWithWrongCedentialsShowsError() {

        $currentUser = Factory::create(User::class);

        $this->visit('/')
            ->submitForm('Connexion', ['email' => $currentUser->getEmail(), 'password' => 'heheheh'])
            ->assertSessionHas('error', 'Nous avons été incapables de vous connecter. Merci vérifier vos informations d\'identification et réessayez à nouveau.');
    }

    /**
     * @test if you are no connected you are redirected to login page
     */
    public function testNoLoggedRedirectLoginPage() {

        Route::enableFilters();
        $this->call('GET', 'dashboard');
        $this->assertRedirectedToRoute('auth.login');
    }

}