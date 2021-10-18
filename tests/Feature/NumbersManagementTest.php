<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\Number;
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

    public function test_a_user_cant_add_a_number_from_another_user_board()
    {
        $board         = Board::factory()->for(User::factory())->create();
        $maliciousUser = User::factory()->create();

        $response = $this->actingAs($maliciousUser)->postJson('/api/boards/'.$board->id.'/numbers', [
            'value'       => 1234,
            'description' => 'Number of something'
        ]);

        $response->assertStatus(401);
    }

    public function test_a_user_can_update_a_number_from_its_board()
    {
        $board = Board::factory()->for(User::factory())->hasNumbers(Number::factory(['value' => 1234, 'description' => 'Initial description']))->create();

        $response = $this->actingAs(User::find($board->user_id))->putJson('/api/boards/' . $board->id . '/numbers/' . $board->numbers->first()->id, ['value' => 5678, 'description' => 'Updated description']);

        $response->assertStatus(200)->assertJsonFragment(['value' => 5678, 'description' => 'Updated description']);
        $this->get('/api/boards/' . $board->id)->assertJsonPath('numbers.0.value', 5678);
    }

    public function test_a_user_cant_update_a_number_from_another_user_board()
    {
        $board         = Board::factory()->for(User::factory())->hasNumbers(Number::factory([
            'value'       => 1234,
            'description' => 'Initial description'
        ]))->create();
        $maliciousUser = User::factory()->create();

        $response = $this->actingAs($maliciousUser)->putJson('/api/boards/'.$board->id.'/numbers/'.$board->numbers->first()->id,
            [
                'value'       => 5678,
                'description' => 'Updated description'
            ]);

        $response->assertStatus(401);
    }
}
