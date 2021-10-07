<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_fails_when_no_param()
    {
        $response = $this->postJson('api/register');

        $response->assertStatus(422);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }

    public function test_registration_fails_when_wrong_email_format()
    {
        $response = $this->postJson('api/register', ['email' => 'benjamin.com']);

        $response->assertJsonPath('errors.email', ['The email must be a valid email address.']);
    }

    public function test_registration_fails_when_password_less_than_8_char()
    {
        $response = $this->postJson('api/register', ['password' => '1234']);

        $response->assertJsonFragment(['The password must be at least 8 characters.']);
    }

    public function test_registration_fails_when_passwords_dont_match()
    {
        $response = $this->postJson('api/register', ['password' => '12345678', 'password_confirmation' => '12345677',]);

        $response->assertJsonFragment(['The password confirmation does not match.']);
    }

    public function test_registration_fails_when_no_username()
    {
        $response = $this->postJson('api/register');

        $response->assertJsonFragment(['The name field is required.']);
    }

    public function test_registration_goes_well()
    {
        $response = $this->postJson('api/register', ['email' => 'benj@min.com', 'name' => 'Benjamin', 'password' => '123456789', 'password_confirmation' => '123456789']);

        $response->assertStatus(201);
    }
}
