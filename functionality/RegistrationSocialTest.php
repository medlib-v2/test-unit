<?php

namespace Medlib\Tests\Functionality;

use Medlib\Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;

class RegistrationSocialTest extends TestCase
{
    public function testItCallsTheFacebookCallback()
    {
        /**
        $abstractUser = \Mockery::mock('Laravel\Socialite\Two\User');
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

        $provider = \Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);

        Socialite::shouldReceive('driver')->with('facebook')->andReturn($provider);

        $this->visit(route("auth.social", ['provider' => 'facebook']))
            ->seePageIs(route("home"));

        **/
    }
}
