<?php

namespace App\Http\Requests\Api\Membership;

use Illuminate\Foundation\Http\FormRequest;

class SearchMembershipRequest extends FormRequest
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
            'sort' => 'nullable|string',
            'filter' => 'nullable|integer|in:0,100,500,1000,10000',
            'search' => 'nullable|string',
            'perPage' => 'nullable|integer|min:1',
        ];
    }
}
