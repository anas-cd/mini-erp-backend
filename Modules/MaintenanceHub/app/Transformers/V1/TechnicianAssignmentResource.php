<?php

namespace Modules\MaintenanceHub\Transformers\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TechnicianAssignmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "maintenance_request_id" => $this->maintenance_request_id,
            "technician_id" => $this->technician_id,
            "status" => $this->status,
            "task" => $this->task,
            "assigned_at" => $this->assigned_at,
            "complted_at" => $this->complted_at,
        ];
    }
}
