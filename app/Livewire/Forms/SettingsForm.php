<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SettingsForm extends Form
{
    #[Locked]
    public User $user;

    #[Validate]
    public $banner;

    #[Validate]
    public $avatar;

    #[Validate]
    public string $name;

    #[Validate]
    public string $username;

    #[Validate]
    public ?string $current_password;

    #[Validate]
    public ?string $password;

    #[Validate]
    public ?string $password_confirmation;

    protected function rules(): array
    {
        return [
            'banner'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5000'],
            'avatar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5000'],
            'name'             => ['nullable', 'filled', 'string', 'max:100', 'regex:/^[A-Za-zА-Яа-яЁё ]+$/u'],
            'username'         => ['nullable', 'filled', 'string', Rule::unique('users')->ignore($this->user), 'max:100', 'regex:/^[A-Za-z0-9._-]+$/'],
            'current_password' => ['nullable', 'string', 'current_password', 'min:8'],
            'password'         => ['nullable', 'string', 'confirmed', 'min:8'],
        ];
    }
}
