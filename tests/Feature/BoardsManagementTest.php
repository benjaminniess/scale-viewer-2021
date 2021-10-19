<?php

namespace Tests\Feature;

use App\Models\Board;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardsManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_add_a_board(): void
    {
        $user = User::factory()->create();

        $this->get('/api/boards')->assertExactJson([]);

        $response = $this->actingAs($user)->postJson('/api/boards', ['title' => 'My board title', 'description' => 'My board description']);

        $response->assertStatus(201)->assertJsonFragment(['title' => 'My board title', 'description' => 'My board description']);
        $this->get('/api/boards')->assertJsonCount(1);
    }

    public function test_a_user_cant_add_a_board_with_missing_title()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/boards', ['description' => 'My board description']);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.title', ['The title field is required.']);
    }

    public function test_a_user_cant_add_a_board_with_a_long_title()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/boards', ['title' => 'My board long long long long very long long exctremely long long long long long too lon title', 'description' => 'My board description']);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.title', ['The title must not be greater than 90 characters.']);
    }

    public function test_a_user_cant_add_a_board_with_missing_description()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/boards', ['title' => 'My board title']);

        $response->assertStatus(422);
        $response->assertJsonPath('errors.description', ['The description field is required.']);
    }

    public function test_a_non_logged_user_cant_add_a_board(): void
    {
        $response = $this->postJson('/api/boards', ['title' => 'My board title', 'description' => 'My board description']);

        $response->assertStatus(401);
    }

	public function test_a_user_can_edit_a_board() {
		$board = Board::factory()->for(User::factory())->create();

		$response = $this->actingAs(User::find($board->user_id))->putJson('/api/boards/' . $board->id, ['title' => 'My updated title', 'description' => 'My board description']);

        $response->assertStatus(200)->assertJsonFragment(['id' => $board->id, 'title' => 'My updated title']);
    }

    public function test_a_user_cant_update_other_users_board()
    {
	    $board = Board::factory()->for(User::factory())->create();
		$maliciousUser = User::factory()->create();

	    $response = $this->actingAs($maliciousUser)->putJson('/api/boards/' . $board->id, ['title' => 'My updated title', 'description' => 'My board description']);

        $response->assertStatus(403);
    }
}
