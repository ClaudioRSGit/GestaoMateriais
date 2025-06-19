<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['is_active' => 1]);
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request)
    {
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if ($user && ! $user->is_active) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                $this->username() => [__('A sua conta está desativada.')],
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function redirectTo()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return '/home';
        } elseif ($user->role === 'user') {
            return route('user.profile');
        } else {
            return '/home';
        }
    }
}
