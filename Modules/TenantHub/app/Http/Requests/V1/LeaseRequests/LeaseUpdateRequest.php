<?php

namespace Modules\TenantHub\Http\Requests\V1\LeaseRequests;

use Illuminate\Foundation\Http\FormRequest;

class LeaseUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            "tenant_email" => ["sometimes", "email"],
            "lease_details" => ["sometimes", "json"],
            "deposit" => ["sometimes", "numeric"],
            "property_id" => ["sometimes", "string"],
            "monthly_rent" => ["sometimes", "numeric"],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (isset($this->lease_details)) {
            $this->merge([
                "lease_details" => json_encode($this->lease_details)
            ]);
        }
    }
}
