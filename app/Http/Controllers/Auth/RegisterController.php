<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $data['username'] = strtolower($data['username']);
            $data['avatar'] = 'https://avatar.iran.liara.run/username?username=' . $data['username'];

            $user = User::create($data);

            Auth::login($user);

            notyf()->success(__('flasher.auth.success'));

            return redirect()->route('welcome');
        } catch (Exception $e) {
            Log::error('While registering: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));

            return redirect()->back();
        }
    }
}
