<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Medlib\Models\User;
use Illuminate\View\View;
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

        Auth::login($currentUser);

        $userRepository = new EloquentUserRepository;
        $messageController = new MessageController;
        $response = $messageController->create($otherUser->getUsername(), $userRepository);

        $this->assertInstanceOf(View::class, $response);
    }
}
