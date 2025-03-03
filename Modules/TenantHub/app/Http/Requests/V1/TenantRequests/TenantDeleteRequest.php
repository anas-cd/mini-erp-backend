<?php

namespace Modules\TenantHub\Http\Requests\V1\TenantRequests;

use Illuminate\Foundation\Http\FormRequest;

class TenantDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // permissions check
        return true;
    }
}
