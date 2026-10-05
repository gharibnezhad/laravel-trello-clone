<?php

namespace Web\User\Tests\Feature;

use Symfony\Component\Process\Process;
use Tests\TestCase;
use Web\User\Models\EmailChange;
use Web\User\Models\User;

class EmailChangeConcurrencyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_only_one_process_can_confirm_the_same_email_change(): void
    {
        $this->assertSame(
            'mysql',
            config('database.default'),
            'Concurrency test must run against MySQL/MariaDB.'
        );

        $user = User::factory()->create([
            'email' => 'concurrency-old@example.com',
            'email_verified_at' => now(),
        ]);

        $token = 'concurrency-test-token-123';

        $emailChange = EmailChange::create([
            'user_id' => $user->id,
            'current_email' => $user->email,
            'new_email' => 'concurrency-new@example.com',
            'token_hash' => hash('sha256', $token),
            'approve_token_hash' => hash(
                'sha256',
                'concurrency-approve-token'
            ),
            'deny_token_hash' => hash(
                'sha256',
                'concurrency-deny-token'
            ),
            'security_confirmed_at' => now(),
            'expires_at' => now()->addMinutes(30),
        ]);

        $processA = new Process([
            PHP_BINARY,
            'artisan',
            'test:email-change-worker',
            $token,
        ]);

        $processB = new Process([
            PHP_BINARY,
            'artisan',
            'test:email-change-worker',
            $token,
        ]);

        $processA->start();

        usleep(500_000);

        $processB->start();

        $processA->wait();
        $processB->wait();


        $outputA = json_decode(
            $processA->getOutput(),
            true
        );

        $outputB = json_decode(
            $processB->getOutput(),
            true
        );

        $statuses = [
            $outputA['status'] ?? null,
            $outputB['status'] ?? null,
        ];

        sort($statuses);

        $this->assertSame(
            ['failed', 'success'],
            $statuses
        );

        $emailChange->refresh();
        $user->refresh();

        $this->assertTrue(
            $emailChange->isConfirmed()
        );

        $this->assertNull(
            $emailChange->change_denied_at
        );

        $this->assertSame(
            'concurrency-new@example.com',
            $user->email
        );

        $this->assertNull(
            $user->email_verified_at
        );


    }
}
