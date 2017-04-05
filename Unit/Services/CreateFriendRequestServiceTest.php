<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Services\CreateFriendRequestService;
use Medlib\Repositories\User\EloquentUserRepository;

class CreateFriendRequestServiceTest extends TestCase
{
    /**
     *
     */
    public function testHandleReturnsTrueOnSuccesfulFriendRequest()
    {
        $requestedUser = Factory::create(User::class);
        $requesterUser = Factory::create(User::class);

        Auth::login($requesterUser);

        $userRepository = new EloquentUserRepository;

        $request = new Request(['username' => $requestedUser->getUsername()]);
        $service = new CreateFriendRequestService($request);
        $response = $service->handle($userRepository);

        $this->assertEquals(1, $requestedUser->friendRequests()->count());
        $this->assertTrue($response);
    }
}