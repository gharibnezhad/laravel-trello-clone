<?php

namespace Web\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Web\User\Models\User;

class LoginTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_can_see_user_login_page()
    {
        $response = $this->get('login');

        $response->assertStatus(200);
    }

    public function test_user_login_by_email()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => bcrypt('Ali123456@1')
        ]);

        $response = $this->post(route('login'), [
            'login' => $user->email,
            'password' => 'Ali123456@1'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_login_by_mobile()
    {
        $user = User::create([
            "name" => $this->faker->name,
            "email" => $this->faker->safeEmail,
            "mobile" => "09123471128",
            "password" => bcrypt('Ali123456'),
        ]);

        $response = $this->post(route('login'), [
            "login" => "09123471128",
            "password" => 'Ali123456'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_login_with_invalid_password()
    {
        $user = User::factory()->create();

         $this->post(route('login'),[
            'login' => $user->email,
            'password' => 'wrong-password'
        ]);

        $this->assertGuest();
    }
}
