<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    use WithoutMiddleware;
    //use DatabaseMigrations;

    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $manager;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://medlib-v2.lan';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication() {

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $app['config']->set('session', [
            'driver'          => 'array',
            'lifetime'        => 120,
            'expire_on_close' => false,
            'encrypt'         => false,
            'files'           => storage_path('framework/sessions'),
            'connection'      => null,
            'table'           => 'sessions',
            'cookie'          => 'medlib_session',
            'lottery'         => [2, 100],
            'path'            => '/',
            'domain'          => 'medlib-v2.lan',
            'secure'          => false,
        ]);

        return $app;
    }

    /**
     * Settings the environment test
     * @return void
     */
    public function setUp() {
        parent::setUp();

        Session::setDefaultDriver('array');

        $this->createApplication();
        $this->artisanMigrateRefresh();
    }

    /**
     * Resetting all information this environment test
     * @return void
     */
    public function tearDown() {
        parent::tearDown();
        $this->artisanMigrateReset();
    }

    /**
     * Push in database all tables with in content
     * @return void
     */
    protected function artisanMigrateRefresh() {
        Artisan::call('migrate');
        DB::beginTransaction();
    }

    /**
     * Resetting all tables with content in database
     * @return void
     */
    protected function artisanMigrateReset() {
        //Artisan::call('migrate:reset');
        DB::rollback();
    }

}
