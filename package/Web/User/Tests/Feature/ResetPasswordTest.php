<?php

namespace Web\User\Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Web\User\Models\User;

class ResetPasswordTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_users_can_see_reset_password_request_form()
    {
        $response = $this->get(route('password.request'));

        $response->assertOk();
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('password.email'),[
           'email'=> $user->email,
        ]);

        Notification::assertSentTo($user,ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered_with_token()
    {
        Notification::fake();

        $user = User::factory()->create();

        $this->post(route('password.email'),[
            'email'=> $user->email,
        ]);

        Notification::assertSentTo($user,ResetPassword::class,function ($notification){
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }


}
