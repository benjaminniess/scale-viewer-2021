<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

	private $correctUserCredentials = ['email' => 'benj@min.com', 'password' => '123456789', 'device_name' => 'Device name'];
	private $correctUserRegisterData = ['email' => 'benj@min.com', 'name' => 'Benjamin', 'password' => '123456789', 'password_confirmation' => '123456789'];

    public function test_login_fails_with_wrong_credentials()
    {
        $response = $this->postJson('/api/login', $this->correctUserCredentials );

        $response->assertStatus(422);
        $response->assertJsonFragment(['The given data was invalid.']);
    }

	public function test_login_fails_without_device_name()
	{
		$this->postJson('api/register', $this->correctUserRegisterData);

		$credentials = $this->correctUserCredentials;
		unset($credentials['device_name']);

		$response = $this->postJson('/api/login', $credentials );

		$response->assertStatus(422);
		$response->assertJsonFragment(['The device name field is required.']);
	}

	public function test_login_fails_with_a_wrong_password()
	{
		$this->postJson('api/register', $this->correctUserRegisterData);

		$credentials = $this->correctUserCredentials;
		$credentials['password'] = 'wrong!password';

		$response = $this->postJson('/api/login', $credentials );

		$response->assertStatus(422);
		$response->assertJsonFragment(['The provided credentials are incorrect.']);
	}

	public function test_login_fails_with_correct_credentials()
	{
		$this->postJson('api/register', $this->correctUserRegisterData);
		$response = $this->postJson('/api/login', $this->correctUserCredentials);

		$response->assertStatus(200);
	}

	public function test_reaching_user_endpoint_without_credentials()
	{
		$response = $this->getJson('/api/user');

		$response->assertStatus(401);
	}

	public function test_reaching_user_endpoint_with_correct_credentials()
	{
		$this->postJson('api/register', $this->correctUserRegisterData);
		$login_request = $this->postJson('/api/login', $this->correctUserCredentials);

		$response = $this->withHeaders([
			'Authorization' => 'Bearer ' . $login_request->content()
		])->getJson('/api/user');

        $response->assertStatus(200);
        $response->assertJsonPath('name', $this->correctUserRegisterData['name']);
        $response->assertJsonPath('email', $this->correctUserRegisterData['email']);
    }

    public function test_logging_out_endpoint_fails_when_not_logged()
    {
        $response = $this->getJson('/api/logout');

        $response->assertStatus(401);
        $response->assertJsonFragment(['message' => 'Unauthenticated.']);
    }

    public function test_logging_out_endpoint_success_when_logged()
    {
        $this->postJson('api/register', $this->correctUserRegisterData);
        $login_request = $this->postJson('/api/login', $this->correctUserCredentials);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $login_request->content()
        ])->getJson('/api/logout');

        $response->assertStatus(200);
        $response->assertSee('logged-out');
    }
}
