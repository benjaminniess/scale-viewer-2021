<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardSingleTest extends TestCase
{
    use RefreshDatabase;

    public function test_route_exists_for_a_single_board(): void
    {
        $board = Board::factory()->for(User::factory())->create();

        $response = $this->get('/api/boards/'.$board->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $board->id, 'title' => $board->title]);
    }

    public function test_a_board_has_no_number(): void
    {
        $board = Board::factory()->for(User::factory())->create();

        $response = $this->get('/api/boards/'.$board->id);

        $response->assertJsonFragment(['numbers' => []]);
    }

    public function test_a_board_has_numbers(): void
    {
        $board = Board::factory()->for(User::factory())->hasNumbers(10)->create();

        $response = $this->get('/api/boards/'.$board->id);

        $response->assertJsonCount(10, 'numbers');
    }
}
