<?php

namespace Web\User\Contracts;

use Web\User\Models\EmailChange;
use Web\User\Models\User;

interface EmailChangeServiceInterface
{

    public function request(User $user, string $newEmail): EmailChange;

    public function approve(string $token): EmailChange;
    public function confirm(string $token): EmailChange;

    public function deny(string $token): EmailChange;
}
