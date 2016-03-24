<?php

use Illuminate\Support\Facades\Hash;

$factory(Medlib\Models\User::class, function (Faker\Generator $faker) {
	return [

		'email' => $faker->unique()->email,
		'username' => $faker->unique()->username,
		'password' => Hash::make(str_random(10)),
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'profession' => $faker->randomElement(['student','researcher', 'teacher']),
		'location' => "",
		'date_of_birth' => $faker->date,
		'gender' => $faker->randomElement(['man','woman']),
		'user_active' => true,
		'account_type' => false,
		'user_avatar' => $faker->imageUrl($width = 180, $height = 180),
		'remember_token' => str_random(10),
		'confirmation_code' => UserTableSeeder::generateToken()
	];
});

$factory(Medlib\Models\Feed::class, function (Faker\Generator $faker){
	return [
		'user_id' => 'factory:Medlib\Models\User',
		'body' => $faker->sentence,
		'poster_firstname'  => $faker->firstName,
		'poster_profile_image'  => $faker->imageUrl($width = 180, $height = 180)
	];
});

$factory(Medlib\Models\FriendRequest::class, function (Faker\Generator $faker){
	return [
		'user_id' => 1,
		'requester_id'  => $faker->numberBetween($min = 2, $max = 30)
	];
});

$factory(Medlib\Models\Message::class, function (Faker\Generator $faker){
	return [
		'body'  => $faker->sentence,
		'senderid' => $faker->randomDigit,
		'sendername' => $faker->name,
		'senderprofileimage' => $faker->imageUrl($width = 180, $height = 180)
	];
});

$factory(Medlib\Models\MessageResponse::class, function(Faker\Generator $faker){
	return [
		'message_id' => 'factory:Medlib\Models\Message',
		'body'  => $faker->sentence,
		'senderid' => $faker->randomDigit,
		'receiverid' => $faker->randomDigit,
		'sendername' => $faker->name,
		'senderprofileimage' => $faker->imageUrl($width = 180, $height = 180)
	];
});
