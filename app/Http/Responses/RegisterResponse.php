<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Http\Responses\RegisterResponse as FortifyRegisterResponse;

/**
 * Stolen from Tuto to disable the auto login after registration
 * https://dev.to/frknasir/fortify-how-to-disable-auto-login-after-user-registration-4kf4
 */
class RegisterResponse extends FortifyRegisterResponse
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function toResponse($request)
    {
        $this->guard->logout();

        return parent::toResponse($request);
    }
}
