<?php

namespace Web\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Web\User\Services\PasswordConfirmationService;

class EnsureProfilePasswordConfirmed
{

    public function __construct(
        protected PasswordConfirmationService $confirmation
    )
    {
    }


    public function handle(Request $request, Closure $next)
    {

        if (!$this->confirmation->isConfirmed()) {

            abort(403);

        }

        return $next($request);
    }
}
