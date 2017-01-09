<?php

namespace Medlib\Tests\Services;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\RemoveFriendService;
use Medlib\Repositories\User\EloquentUserRepository;

class RemoveFriendServiceTest extends TestCase
{

    public function testHandleReturnsTrue()
    {
        $currentUser = Factory::create(User::class);
        $otherUser = Factory::create(User::class);

        Auth::login($currentUser);

        $currentUser->createFriendShipWith($otherUser->id);
        $otherUser->createFriendShipWith($currentUser->id);

        $request = new Request(['username' => $otherUser->getUsername()]);

        $service = new RemoveFriendService($request);

        $repository = New EloquentUserRepository;

        $response = $service->handle($repository);

        $this->assertEquals(0, $currentUser->friends()->count());

        $this->assertTrue($response);
    }
}