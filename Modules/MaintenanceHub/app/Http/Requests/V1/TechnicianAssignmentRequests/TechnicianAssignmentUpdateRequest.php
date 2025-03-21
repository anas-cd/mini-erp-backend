<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnicianAssignmentUpdateRequest extends FormRequest
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
            "maintenance_request_id" => ["sometimes", "string", "exists:maintenance_requests,id"],
            "technician.id" => [
                "sometimes",
                "string",
                "required_without:technician.email"
            ],
            "technician.email" => [
                "sometimes",
                "email",
                "required_without:technician.id"
            ],
            "status" => ["sometimes", "string", Rule::in(['assigned', 'scheduled', 'progress', 'completed'])],
            "task" => ["sometimes", "string"]
        ];
    }
}
