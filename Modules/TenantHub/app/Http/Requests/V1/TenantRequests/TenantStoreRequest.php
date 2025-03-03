<?php

namespace Modules\TenantHub\Http\Requests\V1\TenantRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TenantStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // permissions check
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "user_email" => ["email"],
            "status" => ["required", "string", Rule::in(['active', 'inactive', 'pending'])],
            "gov_id" => ["required", "string"],
            "phone" => ["required", "string"],
            "additional_info" => ["json"]
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "additional_info" => json_encode($this->additional_info)
        ]);
    }

}
