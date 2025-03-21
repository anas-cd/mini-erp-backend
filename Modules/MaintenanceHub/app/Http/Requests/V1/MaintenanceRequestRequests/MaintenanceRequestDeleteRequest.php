<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceRequestDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // permission checks
        return true;
    }
}
