<?php

namespace Modules\MaintenanceHub\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "tenant_id" => $this->tenant_id,
            "title" => $this->title,
            "description" => $this->description,
            "status" => $this->status,
            "priority" => $this->priority,
            "scheduled_at" => $this->scheduled_at
        ];
    }
}
