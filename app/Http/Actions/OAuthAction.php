<?php

namespace App\Http\Actions;

use App\Models\User;
use App\Notifications\AccountCreated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class OAuthAction
{
    public function handle(string $provider): RedirectResponse
    {
        try {
            $user = $this->getUser($provider);

            Auth::login($user, true);

            notyf()->success(__('flasher.auth.success.login'));

            return redirect()->route('welcome');
        } catch (Exception $e) {
            Log::error('While OAuth: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));

            return redirect()->route('auth.register');
        }
    }

    protected function getUser(string $provider): User
    {
        $oauthUser = Socialite::driver($provider)->user();

        if ($user = User::where('email', $oauthUser->getEmail())->first()) {
            return $user;
        }

        $password = Str::password(16, symbols: false);

        $user = User::create([
            'email' => $oauthUser->getEmail(),
            'name'     => trim($oauthUser->getName() ?? $oauthUser->getNickname()),
            'username' => getUsernameSlug(
                $oauthUser->getNickname() ?? $oauthUser->getName(),
                checkForExistence: true
            ),
            'avatar'   => $oauthUser->getAvatar(),
            'password' => $password,
        ]);

        $user->markEmailAsVerified();
        $user->notify(new AccountCreated($password));

        return $user;
    }
}
