<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Board;

class BoardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_boards_list(): void
    {
        $response = $this->get('/api/boards');

        $response->assertStatus(200)->assertExactJson([]);
    }

    public function test_boards_list(): void
    {
        Board::factory()
            ->count(3)
            ->create();

        $response = $this->get('/api/boards');

        $response
            ->assertStatus(200)
            ->assertJsonCount(3);
    }
}
