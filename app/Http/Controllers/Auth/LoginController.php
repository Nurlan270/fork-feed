<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        try {
            $data = $request->validated();
            $field = Validator::make(['login' => $data['login']], ['login' => 'email'])->passes() ? 'email' : 'username';

            if (Auth::attempt([$field => $data['login'], 'password' => $data['password']], $request->filled('remember'))) {
                $request->session()->regenerate();

                notyf()->success(__('flasher.auth.success'));

                return redirect()->route('welcome');
            }

            notyf()->error(__('flasher.invalid_credentials'));
        } catch (Exception $e) {
            Log::error('While logging: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));
        }

        return back()->withInput();
    }
}
