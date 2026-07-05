<?php

namespace Web\User\Services;

use Carbon\Carbon;
use Illuminate\Session\SessionManager;

class PasswordConfirmationService
{

    private const SESSION_KEY ='auth.password_confirmed_at';

    public function __construct(protected SessionManager $session)
    {
    }

    public function confirm() : void
    {
        $this->session->put(self::SESSION_KEY,now()->timestamp);
    }

    public function isConfirmed(int $minutes =2) : bool
    {
        $timestamp = $this->session->get(self::SESSION_KEY);

        if (! $timestamp)
        {
            return false;
        }
        return Carbon::createFromTimestamp($timestamp)
            ->addMinutes($minutes)
            ->isFuture();
    }

    public function forget() : void
    {
         $this->session->forget(self::SESSION_KEY);
    }
}
