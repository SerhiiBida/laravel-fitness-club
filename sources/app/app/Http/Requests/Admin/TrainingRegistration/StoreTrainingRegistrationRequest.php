<?php

namespace App\Http\Requests\Admin\TrainingRegistration;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainingRegistrationRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'training_id' => 'required|exists:trainings,id',
            'status' => 'required|in:active,inactive'
        ];
    }
}
