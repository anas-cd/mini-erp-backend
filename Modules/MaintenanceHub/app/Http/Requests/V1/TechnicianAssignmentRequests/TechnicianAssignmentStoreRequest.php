<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnicianAssignmentStoreRequest extends FormRequest
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
            "maintenance_request_id" => ["required", "string", "exists:maintenance_requests,id"],
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
            "status" => ["nullable", "string", Rule::in(['assigned', 'shceduled', 'progress', 'completed'])],
            "task" => ["required", "string"]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (
                (!isset($this->technician) || !isset($this->technician['id'])) &&
                (!isset($this->technician) || !isset($this->technician['email']))
            ) {
                $validator->errors()->add('technician', 'At least one of technician.id or technician.email is required.');
            }
        });
    }
}
