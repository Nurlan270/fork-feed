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
            $oauthUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate([
                'email' => $oauthUser->getEmail(),
            ], [
                'username' => $this->slug($oauthUser->getNickname() ?? $oauthUser->getName()),
                'avatar' => $oauthUser->getAvatar(),
                'password' => Str::password(16, symbols: false)
            ]);

            Auth::login($user);

            notyf()->success(__('flasher.auth.success'));

            return redirect()->route('welcome');
        } catch (\Exception $e) {
            Log::error('While OAuth: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));

            return redirect()->route('auth.register');
        }
    }

    protected function slug(string $string): string
    {
        return Str::of($string)->trim()->lower()->slug('_');
    }
}
