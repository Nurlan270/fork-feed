<?php

namespace App\Http\Actions;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class OAuthAction
{
    public function handle(string $provider): RedirectResponse
    {
        try {
            $user = $this->getUser($provider);

            Auth::login($user, true);

            auth()->user()->markEmailAsVerified();

            notyf()->success(__('flasher.auth.success.login'));

            return redirect()->route('welcome');
        } catch (\Exception $e) {
            Log::error('While OAuth: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));

            return redirect()->route('auth.register');
        }
    }

    protected function getUser(string $provider): User
    {
        $oauthUser = Socialite::driver($provider)->user();

        return User::firstOrCreate([
            'email' => $oauthUser->getEmail(),
        ], [
            'name' => trim($oauthUser->getName() ?? $oauthUser->getNickname()),
            'username' => getUsernameSlug(
                $oauthUser->getNickname() ?? $oauthUser->getName(),
                checkForExistence: true
            ),
            'avatar' => $oauthUser->getAvatar(),
            'password' => Str::password(16, symbols: false)
        ]);
    }
}
