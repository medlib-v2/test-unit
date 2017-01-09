<?php

namespace Medlib\Tests\Services;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\LoginUserService;

class LoginServiceTest extends TestCase
{
    /**
     *
     */
    public function testHandleReturnsTrueOnsuccesfulLogin()
    {
        $currentUser =  Factory::create(User::class);

        $request = new Request([
            'email' => $currentUser->email,
            'password' => 'secret1983',
            'remember' => false
        ]);

        $loginUserService = new LoginUserService($request);
        $loginUserService->handle();

        $this->assertTrue(Auth::check());

    }
    public function testHandleReturnsFalseOnFailedLogin()
    {
        $request = new Request([
            'email' => 'some@email.com',
            'password' => 'SomePassword',
            'remember' => false
        ]);

        $loginUserService = new LoginUserService($request);
        $loginUserService->handle();

        $this->assertFalse(Auth::check());
    }
}