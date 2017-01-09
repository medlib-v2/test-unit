<?php

namespace Medlib\Tests\Services;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\LogoutUserService;

class LogoutUserServiceTest extends TestCase
{
    public function testHandleReturnsLogout()
    {
        $tempUser = Factory::create(User::class);

        Auth::login($tempUser);

        $logoutUserService = new LogoutUserService();
        $response = $logoutUserService->handle();

        $this->assertFalse($response);
    }
}