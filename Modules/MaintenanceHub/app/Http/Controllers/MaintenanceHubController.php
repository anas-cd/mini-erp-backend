<?php

namespace Modules\MaintenanceHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Modules\MaintenanceHub\Models\TechnicianAssignment;
use Modules\MaintenanceHub\Transformers\V1\TechnicianAssignmentResource;

class MaintenanceHubController extends Controller
{
    use APIResponseTrait;

    public function maintenanceRequestsSummary()
    {
        return $this->success([
            "monthlyRequests" => "50",
            "avgCompletionTime" => "72",
        ], 200);
    }
    public function techniciansSummary()
    {
        return $this->success([
            "techniciansActivityRate" => 0.85,
            "avgRating" => "8",
            "techniciansNumber" => "-15"
        ], 200);
    }
    public function assignmentsSummary()
    {
        return $this->success([
            "newAssignments" => TechnicianAssignmentResource::collection(TechnicianAssignment::all()),
            "canceld" => TechnicianAssignmentResource::collection(TechnicianAssignment::onlyTrashed()->get()),
        ]);
    }
}
