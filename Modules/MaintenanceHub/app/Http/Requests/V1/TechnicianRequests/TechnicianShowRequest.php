<?php

namespace Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianShowRequest extends FormRequest
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
            "email" => ["sometimes", "email", "exists:users,email"],
            "name" => ["sometimes", "string", "exists:technicians,name"]
        ];
    }
}
