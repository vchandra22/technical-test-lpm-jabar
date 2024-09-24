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
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "email" => "test@example.com",
                    "name" => "John Doe"
                ]
            ]);
    }

    public function testGetUnathorized()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current')
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'unauthorized'
                    ]
                ]
            ]);
    }

    public function testGetInvalidToken()
    {
        $this->seed([UserSeeder::class]);

        $this->get('/api/users/current', [
            'Authorization' => 'wrong token'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'unauthorized'
                    ]
                ]
            ]);
    }

    public function testUpdatePasswordSuccess()
    {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('email', 'test@example.com')->first();

        $this->patch(
            '/api/users/current',
            [
                'password' => 'newpassword'
            ],
            [
                'Authorization' => 'Bearer test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    "name" => "John Doe",
                    "email" => "test@example.com"
                ]
            ]);

        $newUser = User::where('email', 'test@example.com')->first();
        self::assertNotEquals($oldUser->password, $newUser->password);
    }

    public function testUpdateNameSuccess()
    {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('email', 'test@example.com')->first();

        $this->patch(
            '/api/users/current',
            [
                'name' => 'Vincent'
            ],
            [
                'Authorization' => 'Bearer test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    "name" => "Vincent",
                    "email" => "test@example.com"
                ]
            ]);

        $newUser = User::where('email', 'test@example.com')->first();
        self::assertNotEquals($oldUser->name, $newUser->name);
    }

    public function testUpdateEmailSuccess()
    {
        $this->seed([UserSeeder::class]);
        $oldUser = User::where('email', 'test@example.com')->first();

        $this->patch(
            '/api/users/current',
            [
                'email' => 'newtest@example.com'
            ],
            [
                'Authorization' => 'Bearer test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    "name" => "John Doe",
                    "email" => "newtest@example.com"
                ]
            ]);

        $newUser = User::where('email', 'newtest@example.com')->first();
        self::assertNotEquals($oldUser->email, $newUser->email);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->patch(
            '/api/users/current',
            [
                'email' => 'test'
            ],
            [
                'Authorization' => 'Bearer test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'email' => [
                        'The email field must be a valid email address.'
                    ]
                ]
            ]);
    }

    public function testLogoutSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->delete(uri: '/api/users/logout', headers: [
            'Authorization' => 'Bearer test'
        ])->assertStatus(200)
            ->assertJson([
                "data" => true
            ]);

        $user = User::where('email', 'test@example.com')->first();
        self::assertNull($user->token);
    }

    public function testLogoutFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->delete(uri: '/api/users/logout', headers: [
            'Authorization' => 'wrongtoken'
        ])->assertStatus(401)
            ->assertJson([
                "errors" => [
                    "message" => [
                        "unauthorized"
                    ]
                ]
            ]);
    }
}
