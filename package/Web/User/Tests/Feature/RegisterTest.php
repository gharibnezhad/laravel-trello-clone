<?php

namespace Web\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Web\User\Models\User;

class RegisterTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_can_see_user_register_form()
    {
        $response =  $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
       $response =  $this->post(route('register'),[
            "name" => 'alireza',
            "email" => 'ali@gmail.com',
            "mobile" => "09123471128",
            "password" => 'Ali123456@',
            "password_confirmation" => 'Ali123456@'
        ]);

        $response->assertRedirect('/home');

        $this->assertCount(1,User::all());
    }

    public function test_user_have_to_verify_account()
    {
         $this->post(route('register'),[
            "name" => 'alireza',
            "email" => 'ali@gmail.com',
            "mobile" => "09123471128",
            "password" => 'Ali123456@',
            "password_confirmation" => 'Ali123456@'
        ]);

        $response = $this->get('/home');

        $response->assertRedirect(route('verification.notice'));
    }
}
