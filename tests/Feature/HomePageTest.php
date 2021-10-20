<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{

    public function test_homepage_is_disabled(): void
    {
        $response = $this->get('/');

        $response->assertStatus(400);
        $response->assertSeeText('API USAGE ONLY');
    }
}
