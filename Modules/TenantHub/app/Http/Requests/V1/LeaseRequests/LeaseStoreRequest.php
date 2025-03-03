<?php

namespace Modules\TenantHub\Http\Requests\V1\LeaseRequests;

use Illuminate\Foundation\Http\FormRequest;

class LeaseStoreRequest extends FormRequest
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
            "tenant_email" => ["required", "email"],
            "lease_details" => ["sometimes", "json"],
            "deposit" => ["required", "numeric"],
            "property_id" => ["required", "string"],
            "monthly_rent" => ["required", "numeric"],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "lease_details" => json_encode($this->lease_details)
        ]);
    }

}
