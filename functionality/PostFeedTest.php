<?php

use Medlib\Models\User;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\Auth;

class PostFeedTest extends TestCase {

	/**
	 * @test if a feed has been published
	 * @return void
	 */
	public function testSuccessfulPostFeed() {
		$currentUser = Factory::create(User::class);


		Auth::login($currentUser);

		 $this->visit('feeds')->submitForm('Publish', ['body' => 'New post']);

		 $feedCount =  $currentUser->feeds()->count();

		 $this->assertEquals(1, $feedCount);
	}
}