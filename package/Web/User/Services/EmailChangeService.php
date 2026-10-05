<?php

namespace Web\User\Services;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Web\User\Contracts\EmailChangeRepositoryInterface;
use Web\User\Contracts\EmailChangeServiceInterface;
use Web\User\Models\EmailChange;
use Web\User\Models\User;
use Web\User\Notifications\EmailChangeConfirmation;
use Web\User\Notifications\EmailChangeSecurityNotification;

class EmailChangeService implements EmailChangeServiceInterface
{

    protected $emailChange;

    public function __construct(protected
      EmailChangeRepositoryInterface $emailChangeRepository)
    {

    }


    public function request(User $user, string $newEmail): EmailChange
    {

        if ($user->email === $newEmail){
            throw new \InvalidArgumentException(
                "The new email must be different from the current email"
            );
        }

        if (! $user->canRequestEmailChange()){
            throw new \DomainException(
                "User already has pending email change"
            );
        }


        $approveToken = Str::random(64);
        $approveTokenHash = hash('sha256', $approveToken);

        $denyToken = Str::random(64);
        $denyTokenHash = hash('sha256',$denyToken);

        $emailChange = $this->emailChangeRepository->create([
            "user_id" => $user->id,
            "current_email" => $user->email,
            "new_email" => $newEmail,
            'approve_token_hash' => $approveTokenHash,
            "deny_token_hash" => $denyTokenHash,
            "expires_at" => now()->addMinutes(30)
        ]);

        $user->notify(
            new EmailChangeSecurityNotification(
                $emailChange,
                $approveToken,
                $denyToken
            )
        );

        return  $emailChange;
    }


    public function approve(string $token): EmailChange
    {
        $tokenHash = hash('sha256', $token);

        return DB::transaction(function () use ($tokenHash) {

            $emailChange = $this->emailChangeRepository
                ->findByApproveTokenHashForUpdate($tokenHash);

            if (! $emailChange) {
                throw new \InvalidArgumentException(
                    'Invalid email change approval token.'
                );
            }

            if ($emailChange->isConfirmed()) {
                throw new \DomainException(
                    'This email change request has already been confirmed.'
                );
            }

            if ($emailChange->isDenied()) {
                throw new \DomainException(
                    'This email change request has already been denied.'
                );
            }

            if ($emailChange->isExpired()) {
                throw new \DomainException(
                    'This email change request has expired.'
                );
            }

            if ($emailChange->security_confirmed_at !== null) {
                throw new \DomainException(
                    'This email change request has already been approved.'
                );
            }

            $confirmationToken = Str::random(64);

            $emailChange->token_hash = hash('sha256', $confirmationToken);
            $emailChange->security_confirmed_at = now();
            $emailChange->save();

            Notification::route('mail', $emailChange->new_email)
                ->notify(
                    new EmailChangeConfirmation(
                        $emailChange,
                        $confirmationToken
                    )
                );

            return $emailChange;
        });
    }


    public function confirm(string $token): EmailChange
    {
        $tokenHash = hash('sha256',$token);

        return DB::transaction(function () use ($tokenHash){

            $emailChange = $this->emailChangeRepository
                ->findByTokenHashForUpdate($tokenHash);

            if (! $emailChange){
                throw new \InvalidArgumentException(
                    'Invalid email change token.'
                );
            }

            if ($emailChange->isConfirmed()) {
                throw new \DomainException(
                    'This email change request has already been confirmed.'
                );
            }

            if ($emailChange->isDenied()) {
                throw new \DomainException(
                    'This email change request has been denied.'
                );
            }

            if ($emailChange->isExpired()) {
                throw new \DomainException(
                    'This email change request has expired.'
                );
            }

            if ($emailChange->security_confirmed_at === null) {
                throw new \DomainException(
                    'This email change request has not been approved yet.'
                );
            }



            $user = $emailChange->user;

            $user->email = $emailChange->new_email;
            $user->email_verified_at = null;
            $user->save();

            $emailChange->confirm();

            return $emailChange;
        });

    }


    public function deny(string $token): EmailChange
    {
        $tokenHash = hash('sha256', $token);

        return DB::transaction(function () use ($tokenHash) {

            $emailChange = $this->emailChangeRepository
                ->findByDenyTokenHashForUpdate($tokenHash);

            if (! $emailChange) {
                throw new \InvalidArgumentException(
                    'Invalid email change deny token.'
                );
            }

            if ($emailChange->isDenied()) {
                throw new \DomainException(
                    'This email change request has already been denied.'
                );
            }

            if ($emailChange->isConfirmed()) {
                throw new \DomainException(
                    'This email change request has already been confirmed.'
                );
            }

            if ($emailChange->isExpired()) {
                throw new \DomainException(
                    'This email change request has expired.'
                );
            }

            if ($emailChange->security_confirmed_at !== null) {
                throw new \DomainException(
                    'This email change request has already been approved.'
                );
            }

            $emailChange->deny();

            return $emailChange;
        });
    }
}
