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
}
