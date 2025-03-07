<?php

namespace Modules\TenantHub\Http\Requests\V1\LeaseRequests;

use Illuminate\Foundation\Http\FormRequest;

class LeaseShowRequest extends FormRequest
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
            "property_id" => ["sometimes", "string"],
            "tenant_email" => ["sometimes", "email"],
        ];
    }
}
