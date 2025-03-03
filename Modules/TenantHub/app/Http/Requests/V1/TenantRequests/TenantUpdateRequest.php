<?php

namespace Modules\TenantHub\Http\Requests\V1\TenantRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // permissions check
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // "user_email" => ["email"],
            "status" => ["sometimes", "string", Rule::in(['active', 'inactive', 'pending'])],
            "gov_id" => ["sometimes", "string"],
            "phone" => ["sometimes", "string"],
            "additional_info" => ["sometimes", "json"]
        ];
    }

    protected function prepareForValidation(): void
    {
        if (isset($this->additional_info)) {
            $this->merge([
                "additional_info" => json_encode($this->additional_info)
            ]);
        }
    }
}
