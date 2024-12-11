<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMembershipRequest extends FormRequest
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
            'price' => 'required|decimal:0,2|min:0|max:9999999',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'validity_days' => 'required|integer|min:1|max:9999',
            'bonuses' => 'required|integer|min:0|max:9999999',
            'is_published' => 'required|boolean',
            'discount_id' => 'nullable|exists:discounts,id',
        ];
    }
}
