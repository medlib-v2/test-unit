<?php

namespace Tests\Feature\TestForms;

use Tests\TestCase;

class SearchSimpleTest extends TestCase
{
    public function testSearchSimpleTestInterface()
    {
        $response = $this->get(route('search.simple', ['query' => 'php', 'qdb' => 'SUDOC', 'title' => 'ti']));
        $response->assertSee('CakePHP 3');
    }
}
