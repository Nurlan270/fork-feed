<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'regex:/^[A-Za-zА-Яа-яЁё ]+$/u'],
            'username' => ['required', 'string', 'unique:users,username', 'max:50', 'regex:/^[A-Za-z0-9._-]+$/'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
            'g-recaptcha-response' => ['required', 'captcha'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Only alphabetical characters and space are allowed',
            'username.regex' => 'Username can\'t contain spaces, or any special characters except: ., -, _',
        ];
    }
}
