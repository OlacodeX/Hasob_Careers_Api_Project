<?php

namespace Tests\Unit;

use Tests\TestCase;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User; 

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_create_user() {

        $data = [
            
           'firstName' => 'Olawale',
           'lastName' => 'Aluko',
            'middleName' => 'Williams',
           'email' => 'aluko798@gmail.com',
           'phone_number' => '08123035672',
            'is_disabled' => 'No',
           'password' => 'aluko798@',
           'picture_url' => 'Img'
        ];
          $this->json('POST', 'api/register', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'firstName',
                    'lastName',
                    'middleName',
                    'phone_number',
                    'is_disabled', 
                    'email', 
                    'picture_url' 
                ]
            ]); 
    }

    public function test_can_update_user() {

        $user = factory(User::class)->create();

        $data = [
           'firstName' => 'Olawale',
           'lastName' => 'Aluko',
            'middleName' => 'Williams',
           'email' => 'aluko798@gmail.com',
           'phone_number' => '08123035672',
            'is_disabled' => 'No',
           'password' => 'aluko798@',
           'picture_url' => 'Img/one.jpg'
        ];
            $this->put(route('user', $user->id), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'firstName',
                    'lastName',
                    'middleName',
                    'phone_number',
                    'is_disabled', 
                    'email', 
                    'picture_url' 
                ]
            ]);  
    }

    public function test_can_show_user() {

        $user = factory(User::class)->create();

        $this->get(route('particularUser', $user->id))
            ->assertStatus(200);
    }

    public function test_can_delete_user() {

        $user = factory(User::class)->create();

        $this->delete(route('removeUser', $user->id))
            ->assertStatus(204);
    }

    public function test_can_list_users() {
        $users = factory(User::class, 2)->create();

        $this->get(route('allUsers'))
            ->assertStatus(200);
    }
}