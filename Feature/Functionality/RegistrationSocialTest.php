<?php

namespace Tests\Feature\Functionality;

use Mockery;
use Medlib\Models\User;
use Tests\BrowserKitTestCase;
use Laravel\Socialite\Facades\Socialite;

class RegistrationSocialTest extends BrowserKitTestCase
{

    public function testItCallsTheFacebookCallback()
    {
        $this->markTestIncomplete();
        /**
        config([
            'FACEBOOK_CLIENT_ID' => 'abc123',
            'FACEBOOK_CLIENT_SECRET' => '123abc',
            'FACEBOOK_OAUTH_REDIRECT' => 'http://medlib.app/api/auth/facebook/callback'
        ]);

        $this->startRequestSession();

        $mockSocialite = Mockery::mock('Laravel\Socialite\Contracts\Factory');
        $this->app['Laravel\Socialite\Contracts\Factory'] = $mockSocialite;

        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('redirect')->twice()->andReturn(redirect(route('auth.social.callback', ['provider' => 'facebook'])));

        $abstractUser = Mockery::mock('\Laravel\Socialite\Contracts\User');
        //$abstractUser = \Mockery::mock('Laravel\Socialite\Two\User');

        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn(str_random(10).'@test.com')
            ->shouldReceive('getNickname')
            ->andReturn('Pseudo')
            ->shouldReceive('getName')
            ->andReturn('Arlette Laguiller')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider->shouldReceive('user')->twice()->andReturn($abstractUser);
        $mockSocialite->shouldReceive('driver')->twice()->with('facebook')->andReturn($provider);
         * Socialite::shouldReceive('driver->facebook')->andReturn(true);
         * Socialite::shouldReceive('driver')->with('facebook')->andReturn(true);

        $this->get(route("auth.social", ['provider' => 'facebook']));
            //->seePageIs(route("home"));

        // http://docs.mockery.io/en/latest/reference/startup_methods.html
        $user = factory(User::class)->make();


        $provider->shouldReceive('redirect')->once()->andReturn(redirect('/auth/facebook/callback'));
        $provider->shouldReceive('user')->once()->andReturn($abstractUser);

        $abstractUser->shouldReceive('getId')->twice()->andReturn(1234567890);
        $abstractUser->shouldReceive('getEmail')->twice()->andReturn($user->email);
        $abstractUser->shouldReceive('getNickname')->once()->andReturn($user->username);
        $abstractUser->shouldReceive('getName')->once()->andReturn($user->name);
        $abstractUser->shouldReceive('getAvatar')->once()->andReturn('avatar_placeholder');

        $this->visit(route("auth.social", ['provider' => 'facebook']));
        //$this->visit('/login/service/google/callback');
        $this->seeInDatabase('users', ['name' => $user->name, 'email' => $user->email]);
        $user = $user->whereEmail($user->email)->first();
        $this->seeInDatabase('social_accounts', ['user_id' => $user->id]);
        **/
    }

    public function testUserLoginWithFacebookAccount()
    {
        $this->markTestIncomplete();

        /**
        config([
            'FACEBOOK_CLIENT_ID' => 'abc123',
            'FACEBOOK_CLIENT_SECRET' => '123abc',
            'FACEBOOK_OAUTH_REDIRECT' => 'http://medlib.app/api/auth/facebook/callback'
        ]);

        $this->startRequestSession();

        $mockSocialite = Mockery::mock('Laravel\Socialite\Contracts\Factory');
        $this->app['Laravel\Socialite\Contracts\Factory'] = $mockSocialite;
        $provider = Mockery::mock('Laravel\Socialite\Contracts\Provider');
        //$provider->shouldReceive('redirect')->andReturn('Redirected');
        $provider->shouldReceive('redirect')->twice()->andReturn(redirect(route('auth.social.callback', ['provider' => 'facebook'])));

        $abstractUser = Mockery::mock('\Laravel\Socialite\Contracts\User');

        //$user = factory(User::class)->make();

        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getEmail')
            ->andReturn(str_random(10).'@noemail.app')
            ->shouldReceive('getNickname')
            ->andReturn('Laztopaz')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider->shouldReceive('user')->twice()->andReturn($abstractUser);
        //$mockSocialite->shouldReceive('driver')->twice()->with('facebook')->andReturn($provider);

        Socialite::shouldReceive('driver')->with('facebook')->andReturn($provider);

        // Test login routes
       $this->get(route("auth.social", ['provider' => 'facebook']))
            ->assertRedirectedToRoute(redirect(route('auth.social.callback', ['provider' => 'facebook'])))
            ->assertResponseStatus(302);

       // Test social callback
       $this->get(redirect(route('auth.social.callback', ['provider' => 'facebook'])))->seePageIs('/login')
            ->see(trans('errors.social_account_not_used', ['socialAccount' => 'Google']));

       $this->visit('/login')->seeElement('#social-login-github')
            ->click('#social-login-github')
            ->seePageIs('/login');

        // Test social callback with matching social account
       DB::table('social_accounts')->insert([
            'user_id' => $this->getAdmin()->id,
            'driver' => 'github',
            'driver_id' => 'logintest123'
       ]);

       $this->visit('/login/service/github/callback')->seePageIs('/');
       **/
    }

    private function startRequestSession() {
        \Request::setLaravelSession($this->manager->driver());
        \Request::session()->put('something', []);
    }
}
