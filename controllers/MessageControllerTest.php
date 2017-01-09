<?php

namespace Medlib\Tests\Controllers;

use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Http\Controllers\Messages\MessageController;

class MessageControllerTest extends TestCase
{
    /**
     * @test if the instance of view is return
     */
    public function testCreateReturnsViewInstance()
    {
        $currentUser = Factory::create(User::class);

        $otherUser = Factory::create(User::class);

        $userRepository = new EloquentUserRepository;

        $messageController = new MessageController;

        Auth::login($currentUser);

        $response = $messageController->create($otherUser->getUsername(), $userRepository);

        $this->assertInstanceOf(View::class, $response);
    }
}
