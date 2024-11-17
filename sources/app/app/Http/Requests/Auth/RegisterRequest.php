<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|between:16,18|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|between:8,16',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'The username field is required.',
            'username.string' => 'The username field must be a string.',
            'username.between' => 'The password must be between 6 and 18 characters.',
            'username.unique' => 'This username is not supported.',
            'email.required' => 'The email field is required.',
            'email.string' => 'The email field must be a string.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.unique' => 'The email address already exists.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password field must be a string.',
            'password.between' => 'The password must be between 8 and 16 characters.'
        ];
    }
}
