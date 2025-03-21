<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianAssignmentDeleteRequest extends FormRequest
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
            //
        ];
    }
}
