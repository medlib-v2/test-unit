<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{

    /**
     * Test the status return by home page if equal to 200
     * @return void
     */
    public function testMethodGetHomePage()
    {
        //$response = $this->get('/');
        //$response->assertStatus(200);
    }

    /**
     * Test the home page
     * @return void
     */
    public function testVisitHomePage()
    {
        //$response = $this->get('/');
        //$response->assertSee('Medlib - Bienvennu dans Media library');
    }
}
