<?php

namespace Web\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Web\User\Models\EmailChange;
use Web\User\Models\User;
use Web\User\Notifications\EmailChangeConfirmation;
use Web\User\Services\EmailChangeService;

class EmailChangeApproveTest extends TestCase
{
    use RefreshDatabase;

    public function test_approve_confirms_security_and_sends_confirmation_email(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);

        $approveToken = 'approve-test-token';

        $emailChange = EmailChange::create([
            'user_id' => $user->id,
            'current_email' => $user->email,
            'new_email' => 'new@example.com',
            'approve_token_hash' => hash(
                'sha256',
                $approveToken
            ),
            'deny_token_hash' => hash(
                'sha256',
                'deny-test-token'
            ),
            'expires_at' => now()->addMinutes(30),
        ]);

        $service = app(EmailChangeService::class);

        $result = $service->approve($approveToken);

        $emailChange->refresh();

        $this->assertSame(
            $emailChange->id,
            $result->id
        );

        $this->assertNotNull(
            $emailChange->security_confirmed_at
        );

        $this->assertNotNull(
            $emailChange->token_hash
        );

        $this->assertNull(
            $emailChange->change_confirmed_at
        );

        $this->assertNull(
            $emailChange->change_denied_at
        );

        $user->refresh();

        $this->assertSame(
            'old@example.com',
            $user->email
        );

        Notification::assertSentOnDemand(
            EmailChangeConfirmation::class
        );
    }


    public function test_approve_cannot_be_used_twice(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);

        $approveToken = 'approve-test-token';

        $emailChange = EmailChange::create([
            'user_id' => $user->id,
            'current_email' => $user->email,
            'new_email' => 'new@example.com',
            'approve_token_hash' => hash('sha256', $approveToken),
            'deny_token_hash' => hash('sha256', 'deny-test-token'),
            'security_confirmed_at' => now(),
            'expires_at' => now()->addMinutes(30),
        ]);

        $this->expectException(\DomainException::class);

        app(EmailChangeService::class)->approve($approveToken);
    }

    public function test_denied_email_change_cannot_be_approved(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);

        $approveToken = 'approve-test-token';

        EmailChange::create([
            'user_id' => $user->id,
            'current_email' => $user->email,
            'new_email' => 'new@example.com',
            'approve_token_hash' => hash('sha256', $approveToken),
            'deny_token_hash' => hash('sha256', 'deny-test-token'),
            'change_denied_at' => now(),
            'expires_at' => now()->addMinutes(30),
        ]);

        $this->expectException(\DomainException::class);

        app(EmailChangeService::class)->approve($approveToken);
    }

    public function test_expired_email_change_cannot_be_approved(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'old@example.com',
            'email_verified_at' => now(),
        ]);

        $approveToken = 'approve-test-token';

        EmailChange::create([
            'user_id' => $user->id,
            'current_email' => $user->email,
            'new_email' => 'new@example.com',
            'approve_token_hash' => hash('sha256', $approveToken),
            'deny_token_hash' => hash('sha256', 'deny-test-token'),
            'expires_at' => now()->subMinute(),
        ]);

        $this->expectException(\DomainException::class);

        app(EmailChangeService::class)->approve($approveToken);
    }
}
