<?php

use Medlib\Models\User;
use Faker\Factory as Faker;
use Laracasts\TestDummy\Factory; 

class RegistrationTest extends TestCase {

	/**
	 * @test if the field first_name is empty
	 * @return void
	 */
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

	/**
	 * @test if the field first_name content short charset
	 * @return void
	 */
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

	/**
	 * @test if the field first_name content number
	 * @return void
	 */
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

	/**
	 * @test if the field last_name is empty
	 * @return void
	 */
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

	/**
	 * @test if the field last_name content short charset
	 * @return void
	 */
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

	/**
	 * @test if the field last_name content number
	 * @return void
	 */
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

	/**
	 * @test if the field username is empty
	 * @return void
	 */
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

	/**
	 * @test if the field username content short charset
	 * @return void
	 */
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

	/**
	 * @test if the field email is empty
	 * @return void
	 */
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

	/**
	 * @test if the email address exist in database
	 * @return void
	 */
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

	/**
	 * @test if the field password is empty
	 * @return void
	 */
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

	/**
	 * @test if the password miss match with password_confirm
	 * @return void
	 */
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

	/**
	 * @test if the field password content short charset
	 * @return void
	 */
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

	/**
	 * @test if the field password_confirm is empty
	 * @return void
	 */
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