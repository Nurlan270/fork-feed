<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\Auth\RegisterForm as Form;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Multiavatar;

class RegisterForm extends Component
{
    public Form $form;

    public function register()
    {
        try {
            $data = $this->form->validate();

            $data['name'] = trim($data['name']);
            $data['avatar'] = $this->generateAvatar();
            $data['username'] = getUsernameSlug($data['username']);

            $user = User::create($data);

            Auth::login($user);

            event(new Registered($user));

            notyf()->success(__('flasher.auth.success.register'));

            return redirect()->intended();
        } catch (Exception $e) {
            Log::error('While registering: ' . $e->getMessage());

            notyf()->error(__('flasher.auth.error'));
        }
    }

    protected function generateAvatar(): string
    {
        $avatar = new Multiavatar();

        $svg = $avatar->generate(mt_rand(1, 1000), null, null);
        $filename = Str::random(32) . '.svg';

        Storage::disk('avatars')->put('tmp/' . $filename, $svg);

        return Storage::url('avatars/tmp/' . $filename);
    }
}
