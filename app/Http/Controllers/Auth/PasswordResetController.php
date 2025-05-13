<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ]);

        if (User::where('email', $request->email)->exists()) {
            Password::sendResetLink(
                $request->only('email')
            );
        }

        notyf()
            ->duration(7000)
            ->info('Password reset link has been sent — if the email you entered is associated with an account');

        return redirect()->route('welcome');
    }

    public function update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );


        if ($status === Password::PasswordReset) {
            notyf()->success(__($status));

            return redirect()->route('auth.login');
        } else {
            notyf()->error(__($status));

            return back();
        }
    }
}
