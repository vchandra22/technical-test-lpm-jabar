<?php

namespace Tests\Feature;

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
}
