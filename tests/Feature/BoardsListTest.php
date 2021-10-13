<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Board;

class BoardsListTest extends TestCase
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

    public function test_board_title_and_description(): void
    {
        Board::factory()->create(['title' => 'My board title', 'description' => 'My board description']);

        $response = $this->get('/api/boards');

        $response->assertJsonPath('0.title', 'My board title');
        $response->assertJsonPath('0.description', 'My board description');
    }

    public function test_a_board_has_a_user_id(): void
    {
        $board = Board::factory()->for(User::factory())->create();

        $response = $this->get('/api/boards');
        $response->assertJsonPath('0.user_id', $board->user_id);
    }
}
