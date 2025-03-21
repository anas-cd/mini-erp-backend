<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // permissions
        return true;
    }
}
