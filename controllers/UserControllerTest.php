<?php

namespace Medlib\Tests\Controllers;

use Medlib\Models\User;
use Illuminate\View\View;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;
use Medlib\Http\Controllers\Users\UsersController;
use Medlib\Repositories\User\EloquentUserRepository;
use Medlib\Repositories\Feed\EloquentFeedRepository;


class TestUserController extends TestCase
{
    /**
     *
     */
    public function testIndexReturnsViewInstance()
    {
        $currentUser = Factory::create(User::class);

        Auth::login($currentUser);

        $userController = new UsersController($currentUser);
        $feedRepository = new EloquentFeedRepository;

        $response = $userController->index($feedRepository);

        $this->assertInstanceOf(View::class, $response);
    }

    /**
     *
     */
    public function testShowReturnsViewInstance()
    {
        $currentUser = Factory::create(User::class);
        $otherUser = Factory::create(User::class);

        Auth::login($currentUser);

        $userController = new UsersController($currentUser);
        $userRepository = new EloquentUserRepository;
        $feedRepository = new EloquentFeedRepository;

        $response = $userController->show($otherUser->username, $userRepository, $feedRepository);
        $this->assertInstanceOf(View::class, $response);
    }
}