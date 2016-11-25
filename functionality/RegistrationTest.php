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
            ->submitForm('Créer un compte', [
			'email' => $email,
			'email_confirm' => $email,
			'username' => $faker->unique()->username,
			'password' => 'secret1983',
			'password_confirm' => 'secret1983',
			'first_name' => '',
			'last_name' => $faker->lastName,
			'profession' => $faker->randomElement(['student','researcher', 'teacher']),
			'day'	=>	$faker->dayOfMonth,
			'month' => $faker->month,
			'year'	=>	'1980',
			'gender' => $faker->randomElement(['man','woman']),
			'profileimage' => $faker->imageUrl($width = 180, $height = 180),

		])->assertSessionHasErrors(['first_name']);
	}

	/**
	 * @test if the field first_name content short charset
	 * @return void
	 */
	public function testFirstNameTooShortShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => 'g',
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
		])->assertSessionHasErrors(['first_name']);
	}

	/**
	 * @test if the field first_name content number
	 * @return void
	 */
	public function testFirstNameContainNumberShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;

		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName.'12344',
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->assertSessionHasErrors(['first_name']);
	}

	/**
	 * @test if the field last_name is empty
	 * @return void
	 */
	public function testLastNameEmptyShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => '',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])
            ->assertSessionHasErrors(['last_name']);
	}

	/**
	 * @test if the field last_name content short charset
	 * @return void
	 */
	public function testLastNameTooShortShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm' => 'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => 'g',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->assertSessionHasErrors(['last_name']);
	}

	/**
	 * @test if the field last_name content number
	 * @return void
	 */
	public function testLastNameContainNumberShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName.'1234',
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])
            ->assertSessionHasErrors(['last_name']);
	}

	/**
	 * @test if the field username is empty
	 * @return void
	 */
	public function testEmptyNicknameShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => '',
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->assertSessionHasErrors(['username']);
	}

	/**
	 * @test if the field username content short charset
	 * @return void
	 */
	public function testEmptyTooShortNicknameShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => '',
				'email_confirm' => $email,
				'username' => 'de',
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->assertSessionHasErrors(['username']);
	}

	/**
	 * @test if the field email is empty
	 * @return void
	 */
	public function testEmptyEmailShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => '',
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180),
			])->assertSessionHasErrors(['email']);
	}

	/**
	 * @test if the email address exist in database
	 * @return void
	 */
	public function testTakenEmailShowsErrorOnSubmit() {
        /**
		$user = Factory::create(User::class);
		$faker = Faker::create();
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $user->getEmail(),
				'email_confirm' => $user->getEmail(),
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['email']);
        **/
	}


	/**
	 * @test if the field password is empty
	 * @return void
	 */
	public function testEmptyPasswordShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => '',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['password']);
	}

	/**
	 * @test if the password miss match with password_confirm
	 * @return void
	 */
	public function testConfirmPasswordShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;

		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'hello1234',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['password_confirm']);
	}

	/**
	 * @test if the field password content short charset
	 * @return void
	 */
	public function testPasswordTooShortShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'h',
				'password_confirm'	=> 	'hello1234',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['password']);
	}

	/**
	 * @test if the field password_confirm is empty
	 * @return void
	 */
	public function testEmptyPasswordConfirmationShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'1983',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['password_confirm']);
	}

	/**
	 * @test if the field year is empty
	 * @return void
	 */
	public function testEmptyYearShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'secret1983',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['year']);
	}

	/**
	 * @test if the field year is string given
	 * @return void
	 */
	public function testNumericYearShowsErrorOnSubmit() {

		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'bab1',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['year']);
	}

	/**
	 * @test if the field year is string given
	 * @return void
	 */
	public function testYearBeforeCurrentShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'2015',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => $faker->imageUrl($width = 180, $height = 180)
			])->assertSessionHasErrors(['year']);
	}

	/**
	 * @test if the field profileImage attached an image file
	 * @return void
	 */
	public function testEmptyImageShowsErrorOnSubmit() {
		$faker = Faker::create();
		$email = $faker->unique()->email;
		$this->visit('/register')
			->submitForm('Créer un compte', [
				'email' => $email,
				'email_confirm' => $email,
				'username' => $faker->unique()->username,
				'password' => 'secret1983',
				'password_confirm'	=> 	'',
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'profession' => $faker->randomElement(['student','researcher', 'teacher']),
				'day'	=>	$faker->dayOfMonth,
				'month' => $faker->month,
				'year'	=>	'2015',
				'gender' => $faker->randomElement(['man','woman']),
				'profileimage' => ''
			])->assertSessionHasErrors(['profileimage']);
	}


}
