<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'name' => 'John Doe',
                    'email' => 'test@example.com',
                ]
            ]);
    }

    public function testRegisterFailed()
    {
        $this->post('/api/users', [
            'name' => '',
            'email' => '',
            'password' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'name' => [
                        'The name field is required.'
                    ],
                    'email' => [
                        'The email field is required.'
                    ],
                    'password' => [
                        'The password field is required.'
                    ],
                ]
            ]);
    }

    public function testRegisterEmailAlreadyExists()
    {
        $this->testRegisterSuccess();
        $this->post('api/users', [
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password'
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'email' => []
                ]
            ]);
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/users/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'John Doe',
                    'email' => 'test@example.com'
                ]
            ]);

        $user = User::where('email', 'test@example.com')->first();
        self::assertNotNull($user->token);
    }

    public function testLoginEmailNotFound()
    {
        $this->post('/api/users/login', [
            'email' => 'test@example.com',
            'password' => 'password'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    "message" => [
                        "email or password wrong"
                    ]
                ]
            ]);
    }

    public function testLoginPasswordWrong()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/users/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    "message" => [
                        "email or password wrong"
                    ]
                ]
            ]);
    }

    public function testGetSucces()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current', [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "email" => "test@example.com",
                    "name" => "John Doe"
                ]
            ]);
    }
}
