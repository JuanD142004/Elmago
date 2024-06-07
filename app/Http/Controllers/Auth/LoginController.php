<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|exists:users,email',
            'password' => 'required|string',
        ], [
            'email.exists' => 'El correo electrónico no se encuentra registrado en la base de datos.',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $errors['email'] = trans('auth.throttle', ['seconds' => $this->limiter()->availableIn(
                $this->throttleKey($request)
            )]);
        } else {
            if (!$this->guard()->validate($this->credentials($request))) {
                $errors = ['password' => 'La contraseña proporcionada es incorrecta.'];
            }
        }

        throw ValidationException::withMessages($errors);
    }
}
    

