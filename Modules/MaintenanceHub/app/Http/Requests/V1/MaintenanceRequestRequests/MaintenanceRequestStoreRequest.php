<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MaintenanceRequestStoreRequest extends FormRequest
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
            "tenant.id" => ["sometimes", "string"],
            "tenant.email" => ["sometimes", "email", "exists:users,email"],
            "tenant.phone" => ["sometimes", "string", "exists:tenants,phone"],
            "title" => ["required", "string"],
            "description" => ["required", "string"],
            "status" => ["sometimes", "string", Rule::in(['recieved', 'scheduled', 'repairing', 'completed', 'reshceduled'])],
            "priority" => ["sometimes", "string", Rule::in(['low', 'mid', 'high', 'urgent', 'ww3'])],
            "schedule" => ["sometimes", "date"]
        ];
    }
}
