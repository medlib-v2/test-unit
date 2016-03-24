<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class PostFeedTest extends TestCase {

	public function testSuccesfulPostFeed() {
		$currentUser = Factory::create(User::class);


		Auth::login($currentUser);

		 $this->visit('feeds')->submitForm('Publish', ['body' => 'New post']);

		 $feedCount =  $currentUser->feeds()->count();

		 $this->assertEquals(1, $feedCount);
	}
}