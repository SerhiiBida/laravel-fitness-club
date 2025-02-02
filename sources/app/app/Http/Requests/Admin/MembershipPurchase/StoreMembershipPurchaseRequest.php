<?php

namespace App\Http\Requests\Admin\MembershipPurchase;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipPurchaseRequest extends FormRequest
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
            'membership_id' => 'required|exists:memberships,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:paid,pending,cancelled',
            'expired_at' => 'nullable|date|after_or_equal:today'
        ];
    }
}
