<?php

use Medlib\Models\User;
use Faker\Factory as Faker;
use Laracasts\TestDummy\Factory; 

class RegistrationTest extends TestCase {

	public function testEmptyFirstNameShowsErrorOnSubmit() {


		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
            ->submitForm('Submit', [
			'email' => $email,
			'email_confirm' => $email,
			'username' => $faker->unique()->username,
			'password' => 'secret1983',
			'password_confirm' => 'secret1983',
			'first_name' => '',
			'last_name' => $faker->lastName,
			'profession' => $faker->randomElement(['student','researcher', 'teacher']),
			'location' => "",
			'day'	=>	$faker->dayOfMonth,
			'month' => $faker->month,
			'year'	=>	'1980',
			'gender' => $faker->randomElement(['man','woman']),
			'profileimage' => $faker->imageUrl($width = 180, $height = 180),

		])->see('The First Name field is required.');
	}

	public function testFirstNameTooShortShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => 'g',
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
		])->see('The First Name must be at least 3 characters');
	}

	public function testFirstNameContainNumberShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;

		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName.'12344',
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->seeCookie('errors', 'first_name', 'The First Name may only contain letters.');
	}

	public function testLastNameEmptyShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => '',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])
            ->see('The Last Name field is required.');
	}

	public function testLastNameTooShortShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => 'g',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->see('The Last Name must be at least 3 characters.');
	}

	public function testLastNameContainNumberShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName.'1234',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])
            ->see('The Last Name may only contain letters.');
	}

	public function testEmptyNicknameShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => '',
				'email_confirm' => $email,
				'username' => '',
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->see('The Nickname field is required.');
	}

	public function testEmptyTooShortNicknameShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => '',
				'email_confirm' => $email,
				'username' => 'de',
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->see('The Nickname must be at least 3 characters.');
	}

	public function testEmptyEmailShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => '',
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->see('The E-mail field is required.');
	}

	public function testTakenEmailShowsErrorOnSubmit() {

		$user = Factory::create(User::class);
		$faker = Faker::create();
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $user->getEmail(),
				'email_confirm' => $user->getEmail(),
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The email has already been taken.');
	}

	public function testEmptyPasswordShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => '',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The Password field is required.');
	}

	public function testConfirmPasswordShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;

		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'hello1234',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The Password Confirmation and Password must match.');
	}

	public function testPasswordTooShortShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'h',
				'password_confirm'	=> 	'hello1234',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The Password must be at least 6 characters');
	}

	public function testEmptyPasswordConfirmationShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The Password Confirmation field is required');
	}

	public function testEmptyYearShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The year field is required');
	}

	public function testNumericYearShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'bab1',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The year must be a number.');
	}

	public function testYearBeforeCurrentShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'2015',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->see('The year must be a date before 2000.');
	}

	public function testEmptyImageShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Submit', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'location' => "",
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'2015',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => ''
			])->see('Your profile image is required.');
	}


}