<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NumbersManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_add_a_number_to_its_board()
    {
        $board = Board::factory()->for(User::factory())->create();

        $response = $this->actingAs(User::find($board->user_id))->postJson('/api/boards/' . $board->id . '/numbers', ['value' => 1234, 'description' => 'Number of something']);

        $response->assertStatus(201)->assertJsonFragment(['value' => 1234, 'description' => 'Number of something']);
        $this->get('/api/boards/' . $board->id)->assertJsonPath('numbers.0.value', 1234);
    }
}
