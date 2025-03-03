<?php

namespace Modules\TenantHub\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "tenant_id" => $this->tenant_id,
            "deposit" => $this->deposit,
            "property_id" => $this->property_id,
            "move_in_date" => $this->move_in_date,
            "move_out_date" => $this->move_out_date,
            "monthly_rent" => $this->monthly_rent,
        ];
    }
}
