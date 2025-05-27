<?php

namespace App\Http\Requests\Recipes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;

class UpdateRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update', $this->route('recipe'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'          => ['required', 'string', 'max:100'],
            'description'    => ['required', 'string', 'max:10000'],
            'ingredients'    => ['required', 'min:1'],
            'images'         => ['sometimes', 'array', 'min:1', 'max:20'],
            'images.*'       => ['sometimes', File::image()->max('15MB')],
            'deleted_images' => ['sometimes', 'json'],
        ];
    }
}
