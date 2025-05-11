<?php

namespace App\Http\Controllers\Auth;

use App\Http\Actions\OAuthAction;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(OAuthAction $action)
    {
        $action->handle('google');
    }
}
