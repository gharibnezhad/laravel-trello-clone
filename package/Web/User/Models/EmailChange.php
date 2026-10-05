<?php

namespace Web\User\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EmailChange extends Model
{

    protected $table = 'email_changes';


    protected $fillable = [
        'user_id',
        'current_email',
        'new_email',
        'token_hash',
        'deny_token_hash',
        'approve_token_hash',
        'change_confirmed_at',
        'change_denied_at',
        'security_confirmed_at',
        'expires_at',
    ];


    protected $casts = [
        'change_confirmed_at' => 'datetime',
        'change_denied_at' => 'datetime',
        'security_confirmed_at' => 'datetime',
        'expires_at' => 'datetime',
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isConfirmed() : bool
    {
        return ! is_null($this->change_confirmed_at);
    }

    public function isDenied() : bool
    {
        return ! is_null($this->change_denied_at);
    }

    public function isExpired() : bool
    {
        return $this->expires_at !== null
            && $this->expires_at->isPast();
    }


    public function isPending() : bool
    {
        return ! $this->isConfirmed()
            && ! $this->isDenied();
    }

    public function scopePending(Builder $query) : Builder
    {
        return $query->whereNull('change_confirmed_at')
            ->whereNull('change_denied_at')
            ->where('expires_at','>',now());
    }

    public function confirm() : bool
    {
          $this->change_confirmed_at = now();
          return  $this->save();
    }

    public function deny() : bool
    {
        $this->change_denied_at = now();
        return $this->save();
    }


}
