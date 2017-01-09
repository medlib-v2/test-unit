<?php

namespace Medlib\Tests\Events;

use Medlib\Models\User;
use Medlib\Tests\TestCase;
use Laracasts\TestDummy\Factory;
use Medlib\Events\UserWasRegistered;

class UserWasRegisteredTest extends TestCase
{
    public function testUserObjectExistInClass()
    {
        $user = Factory::create(User::class);

        $event = new UserWasRegistered($user);

        $this->assertEquals($user->firstname, $event->user->firstname);
    }
}
