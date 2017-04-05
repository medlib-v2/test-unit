<?php

namespace Tests;

use Medlib\Models\User;
use Medlib\Models\Profile;
use Medlib\Models\Timeline;
use Tests\Traits\TestHelpers;
use Laracasts\TestDummy\Factory;
use Illuminate\Support\Facades\DB;
use Tests\Traits\DatabaseMigrations;
use Tests\Traits\CreatesApplication;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use TestHelpers, CreatesApplication, WithoutMiddleware, DatabaseMigrations;

    /**
    * @var \Illuminate\Session\SessionManager
    */
    protected $manager;

    /**
     * Settings the environment test
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        /**
         * Avoid "Session store not set on request." - Exception!
         * @see http://laravel-tricks.com/tricks/unit-test-session-store-not-set-on-request
         * Session::setDefaultDriver('array');
         * Session::start();
         */
        $this->manager = app('session');
    }

    /**
     * Resetting all information this environment test
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        $this->artisanMigrateReset();
    }

    /**
     * @return User
     */
    public function getUser()
    {
        $timeline = Factory::create(Timeline::class);

        list($first_name, $last_name) = explode(' ', $timeline->name);

        $user = Factory::create(User::class, [
            'timeline_id' => $timeline->id,
            'username' => $timeline->id,
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        $user->profile()->save(
            factory(Profile::class)->make()
        );

        $user_settings = [
            'user_id' => $user->id,
            'confirm_follow' => 'no',
            'follow_privacy' => 'everyone',
            'comment_privacy' => 'everyone',
            'timeline_post_privacy' => 'only_follow',
            'post_privacy' => 'everyone',];

        DB::table('user_settings')->insert($user_settings);

        $user->roles()->attach(1);

        return $user;
    }
}
