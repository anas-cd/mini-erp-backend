<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnicianStoreRequest extends FormRequest
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
            "user.email" => ["required", "email"],
            "name" => ["required", "string"],
            "specialization" => ["required", "string"],
            "status" => ["required", "string", Rule::in(['active', 'inactive', 'leave'])],
        ];
    }
}
