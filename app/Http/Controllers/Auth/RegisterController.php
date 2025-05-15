<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Multiavatar;

class RegisterController extends Controller
{
    public function __construct(
        protected Multiavatar $avatar
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $data['avatar'] = $this->generateAvatar();
            $data['username'] = getUsernameSlug($data['username']);

            $user = User::create($data);

            Auth::login($user);

            event(new Registered($user));

            notyf()->success(__('flasher.auth.success.register'));

            return redirect()->route('welcome');
        } catch (Exception $e) {
            Log::error('While registering: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));

            return redirect()->back();
        }
    }

    protected function generateAvatar(): string
    {
        $svg = $this->avatar->generate(mt_rand(1, 1000), null, null);
        $filename = Str::random(32) . '.svg';

        Storage::disk('avatars')->put('tmp/' . $filename, $svg);

        return url('avatars/tmp/' . $filename);
    }
}
