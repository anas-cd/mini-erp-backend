<?php

namespace Modules\TenantHub\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "status" => $this->status,
            "phone" => $this->phone,
            "gov_id" => $this->gov_id,
            "additional_info" => json_decode($this->additional_info)
        ];
    }
}
