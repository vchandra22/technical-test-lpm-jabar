<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'name' => 'Vincent Chandra',
            'email' => 'vincentchaandra@gmail.com',
            'password' => 'password'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'name' => 'Vincent Chandra',
                    'email' => 'vincentchaandra@gmail.com'
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
}
