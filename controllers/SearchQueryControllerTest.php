<?php

use Illuminate\View\View;
use Illuminate\Http\Request;
use Medlib\Http\Controllers\Search\SearchQueryController;

class SearchQueryControllerTest extends TestCase {

    /**
     * @var \Medlib\Http\Controllers\Search\SearchQueryController
     */
    protected static $searchQueryController;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass() {
        self::$searchQueryController = new SearchQueryController;
    }

    public static function tearDownAfterClass() {
        self::$searchQueryController = null;
    }

    /**
     * @test if the page of registration is return
     */
    public function testSearchReturnsViewInstance()
    {
        $request = new Request([
            'query' => 'Victor Hugo',
            'qdb' => 'VOYAGE',
            'title' => 'ti',
            'type' => 'all'
        ]);

        $response = self::$searchQueryController->doSimple($request);

        $this->assertInstanceOf(View::class, $response);
    }
}