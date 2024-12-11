<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Из маршрута
        $userId = $this->route('user')->id;

        return [
            'username' => 'required|string|between:6,30|unique:users,username,' . $userId,
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'password' => [
                'nullable',
                'string',
                'between:8,16',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/'
            ],
            'bonuses' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_staff' => 'required|boolean',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'password.regex' => 'Password must include at least one lowercase letter, one uppercase letter, one digit, and one special character(@$!%*?&).',
        ];
    }
}
