<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Medlib\Http\Requests\SearchQuerySimpleRequest;
use Medlib\Http\Controllers\Search\SearchQueryController;

class SearchQueryControllerTest extends TestCase
{
    /**
     * @var \Medlib\Http\Controllers\Search\SearchQueryController
     */
    protected static $searchQueryController;

    /**
     * Set up the environment of test
     */
    public static function setUpBeforeClass()
    {
        self::$searchQueryController = new SearchQueryController;
    }

    public static function tearDownAfterClass()
    {
        self::$searchQueryController = null;
    }

    /**
     * @test if the page of registration is return
     */
    public function testSearchReturnsJsonResponseInstance()
    {
        $request = new SearchQuerySimpleRequest([
            'query' => 'Victor Hugo',
            'qdb' => 'VOYAGE',
            'title' => 'ti',
            'type' => 'all'
        ]);

        $response = self::$searchQueryController->doSimple($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
