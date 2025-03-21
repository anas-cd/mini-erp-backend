<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequestShowRequest extends FormRequest
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
            "tenant.id" => ["sometimes", "string", "exists:tenants,id"],
            "tenant.email" => ["sometimes", "email", "exists:users,email"],
            "tenant.phone" => ["sometimes", "string", "exists:tenants,phone"],
        ];
    }
}
