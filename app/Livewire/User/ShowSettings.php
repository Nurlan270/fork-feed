<?php

namespace App\Livewire\User;

use App\Livewire\Forms\SettingsForm;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowSettings extends Component
{
    use WithFileUploads;

    public SettingsForm $form;

    public function mount(): void
    {
        $user = auth()->user();
        $this->form->user = $user;
        $this->form->name = $user->name;
        $this->form->username = $user->username;
    }

    public function save(): void
    {
        $data = $this->form->validate();

        $this->handleBannerUpload($data);
        $this->handleAvatarUpload($data);
        $this->handleProfileInfoUpdate($data);
        $this->handlePasswordUpdate($data);

        notyf()->success(__('flasher.settings.updated'));
    }

    protected function handleBannerUpload(array $data): void
    {
        if ($banner = $data['banner']) {
            // Delete the old banner if it exists
            $relativePath = Str::remove(Storage::url('/'), $this->form->user->banner);
            Storage::delete($relativePath);

            $bannerPath = $banner->store('banners');
            $this->form->user->update(['banner' => $bannerPath]);
        }
    }

    protected function handleAvatarUpload(array $data): void
    {
        if ($avatar = $data['avatar']) {
            // Delete the old avatar if it exists
            $relativePath = Str::remove(Storage::url('/'), $this->form->user->avatar);
            Storage::delete($relativePath);

            $avatarPath = Storage::url($avatar->store('avatars'));
            $this->form->user->update(['avatar' => $avatarPath]);
        }
    }

    protected function handleProfileInfoUpdate(array $data): void
    {
        if ($name = $data['name']) {
            $this->form->user->update(['name' => $name]);
        }
        if ($username = $data['username']) {
            $this->form->user->update(['username' => $username]);
        }
    }

    protected function handlePasswordUpdate(array $data): void
    {
        if ($data['current_password'] && $newPassword = $data['password']) {
            $this->form->user->update([
                'password' => bcrypt($newPassword),
            ]);

            $this->reset(['form.current_password', 'form.password', 'form.password_confirmation']);
        }
    }
}
