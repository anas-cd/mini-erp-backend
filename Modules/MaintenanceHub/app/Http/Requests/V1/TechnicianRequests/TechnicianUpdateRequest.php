<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TechnicianUpdateRequest extends FormRequest
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
            "user.email" => ["sometimes", "email"],
            "name" => ["sometimes", "string"],
            "specialization" => ["sometimes", "string"],
            "status" => ["sometimes", "string", Rule::in(['active', 'inactive', 'leave'])],
        ];
    }
}
