<?php

namespace App\Http\Requests\Admin\Training;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTrainingRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'training_type_id' => 'required|exists:training_types,id',
            'user_id' => 'required|exists:users,id',
            'is_published' => 'required|boolean',
            'is_private' => 'required|boolean',
            'memberships' => 'nullable|array',
            'memberships.*' => 'integer|exists:memberships,id',
        ];
    }
}
