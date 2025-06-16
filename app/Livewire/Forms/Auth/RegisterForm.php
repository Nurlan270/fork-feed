<?php

namespace App\Livewire\Forms\Auth;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate]
    public string $name;

    #[Validate]
    public string $username;

    #[Validate]
    public string $email;

    #[Validate]
    public string $password;

    #[Validate]
    public string $password_confirmation;

    #[Validate]
    public $captcha;

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:100', 'regex:/^[A-Za-zА-Яа-яЁё ]+$/u'],
            'username' => ['required', 'string', 'unique:users,username', 'max:100', 'regex:/^[A-Za-z0-9._-]+$/'],
            'email'    => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'captcha'  => ['required', 'captcha'],
        ];
    }
}
