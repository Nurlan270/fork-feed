<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function email(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
        ]);

        try {
            Password::sendResetLink(
                $request->only('email')
            );

            notyf()->success(__('flasher.password_reset_link.success'));

            return redirect()->route('welcome');
        } catch (Exception $e) {
            notyf()->error(__('flasher.password_reset_link.error'));
        }

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
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
