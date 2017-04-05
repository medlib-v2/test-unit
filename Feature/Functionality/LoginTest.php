<?php

namespace Tests\Feature\Functionality;

use Medlib\Models\User;
use Tests\BrowserKitTestCase;
use Laracasts\TestDummy\Factory;

class LoginTest extends BrowserKitTestCase
{
    /**
     * @test if the input email is empty
     * @return void
     */
    public function testEmptyEmailShowsErrorOnSubmit()
    {
        $this->post( route('auth.submit'), [
            'email' => '',
            'password' => 'secret1983'
        ])->seeJson([
            'email' => ['The e-mail field is required.']
        ]);
    }

    /**
     * @test if your email address is not valid
     * @return void
     */
    public function testInvalidEmailShowsErrorOnSubmit()
    {
        $this->post(route('auth.submit'), [
            'email' => 'jondoe.com',
            'password' => 'secret1983'
        ])->seeJson([
            'email' => ['The e-mail must be a valid email address.']
        ]);
    }

    /**
     * @test if the input password is empty
     * @return void
     */
    public function testEmptyPasswordShowsErrorOnSubmit()
    {
        $this->post(route('auth.submit'), [
            'email' => 'jon@Doe.com',
            'password' => ''
        ])->seeJson([
            'password' => ['The password field is required.']
        ]);
    }

    /**
     * @test if your credentials return an error
     * @return void
     */
    public function testLoginWithWrongCredentialsShowsError()
    {
        $currentUser = Factory::create(User::class);
        $this->post(route('auth.submit'), [
            'email' => $currentUser->getEmail(),
            'password' => 'heheheh'
        ])->seeJson([
            'success' => false,
            'data' => ['error' => trans('auth.login.failed')],
            'status_code' => 401
        ]);
    }

    /**
     * @test if you are no connected you are redirected to login page
     * @return void
     */
    public function testNoLoggedReturnsUnauthorized()
    {
        $this->app->instance('middleware.disable', false);
        $this->get(route('profile.show.settings'))->seeJson([
            'error' => 'token_not_provided'
        ])->assertResponseStatus(401);
    }
}
