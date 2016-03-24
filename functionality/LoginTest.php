<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Route;

class LoginTest extends TestCase {


    public function testEmptyEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => '', 'password' => 'secret013'])
            ->seeInSession(['email' => 'Le champ E-mail est obligatoire.']);
            //->visit('/login')
            //->seeCookie('errors', 'email', 'Le champ E-mail est obligatoire.');
    }

    public function testInvalidEmailShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jondoe.com', 'password' => 'secret013'])
            ->seeInSession(['email' => 'Le champ E-mail doit être une adresse email valide.']);
            //->visit('/login')
            //->seeCookie('errors', 'email', 'Le champ E-mail doit être une adresse email valide.');
    }

    public function testEmptyPasswordShowsErrorOnSubmit() {

        $this->visit('/')
            ->submitForm('Connexion', ['email' => 'jon@Doe.com', 'password' => ''])
            ->seeInSession(['email' => 'Le champ Mot de passe est obligatoire.']);
            //->visit('/login')
            //->seeInSession('errors', 'email', 'Le champ Mot de passe est obligatoire.');
    }

    public function testLoginWithWrongCedentialsShowsError() {

        $currentUser = Factory::create(User::class);

        $this->visit('/')
            ->submitForm('Connexion', ['email' => $currentUser->getEmail(), 'password' => 'heheheh'])
            ->seeInSession(['email' => 'We were unable to sign you in. Please check your credentials and try again.']);
            //->visit('/login')
            //->see('We were unable to sign you in. Please check your credentials and try again.');
    }

    /**
     * @test if you are no connected you are redirected to loggin page
     */
    public function testNoLoggedRedirectLoginPage() {

        Route::enableFilters();
        $this->call('GET', 'dashboard');
        $this->assertRedirectedToRoute('login');
    }

}