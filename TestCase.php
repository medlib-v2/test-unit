<?php

namespace Medlib\Tests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use WithoutMiddleware;

    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://medlib.app';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();
        
        return $app;
    }

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
        */
        Session::setDefaultDriver('array');
        $this->manager = app('session');

        $this->createApplication();
        $this->artisanMigrateRefresh();
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
     * Push in database all tables with in content
     * @return void
     */
    protected function artisanMigrateRefresh()
    {
        DB::beginTransaction();
        Artisan::call('migrate');
    }

    /**
     * Resetting all tables with content in database
     * @return void
     */
    protected function artisanMigrateReset()
    {
        //Artisan::call('migrate:reset');
        DB::rollback();
    }
}
