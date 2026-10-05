<?php

namespace Web\User\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Web\User\Models\EmailChange;

trait HasEmailChangeConfirmation
{

    public function emailChanges() : HasMany
    {
        return $this->hasMany(EmailChange::class);
    }


    public function pendingEmailChanges() : HasMany
    {
        return $this->emailChanges()->pending();
    }

    public function hasPendingEmailChange(): bool
    {
        return $this->pendingEmailChanges()->exists();
    }

    public function canRequestEmailChange(): bool
    {
        return ! $this->pendingEmailChanges()->exists();
    }
}
