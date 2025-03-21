<?php

namespace Modules\MaintenanceHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests\TechnicianAssignmentDeleteRequest;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests\TechnicianAssignmentShowRequest;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests\TechnicianAssignmentStoreRequest;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianAssignmentRequests\TechnicianAssignmentUpdateRequest;
use Modules\MaintenanceHub\Models\Technician;
use Modules\MaintenanceHub\Models\TechnicianAssignment;
use App\Traits\APIResponseTrait;
use Modules\MaintenanceHub\Transformers\V1\TechnicianAssignmentResource;

class TechnicianAssignmentController extends Controller
{
    use APIResponseTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnicianAssignmentStoreRequest $request)
    {
        $validated = $request->validated();

        // -- checking technician id --
        if (isset($validated["technician"]["id"])) {

            $validated["technician_id"] = User::where("email", $validated["technician"]["email"])
                ->firstOrFail()->technician?->id;
            unset($validated["technician"]);
        } else
            $validated["technician_id"] = $validated["technician"]["id"];

        // -- assign dates defaults--
        $validated["assigned_at"] = now();
        $validated["completed_at"] = null;
        $validated["status"] = null;

        $assignment = TechnicianAssignment::create($validated);

        return $this->success(TechnicianAssignmentResource::make($assignment), 200, "assignment made successfuly");
    }

    /**
     * Show the specified resource.
     */
    public function show(TechnicianAssignmentShowRequest $request, string $id)
    {
        $validated = $request->validated();

        $assignment = TechnicianAssignment::findOrFail($id);

        return $this->success(TechnicianAssignmentResource::make($assignment), 200, "");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnicianAssignmentUpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $assignment = TechnicianAssignment::findOrFail($id);


        // -- checking technician id --
        if (isset($validated["technician"]["id"])) {

            $validated["technician_id"] = $validated["technician"]["id"];
            unset($validated["technician"]);
        }
        if (isset($validated["technician"]["email"])) {

            $validated["technician_id"] = User::where("email", $validated["technician"]["email"])
                ->firstOrFail()->technician?->id;
            unset($validated["technician"]);
        }

        $assignment->update($validated);

        return $this->success(TechnicianAssignmentResource::make($assignment), 200, "assignment updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TechnicianAssignmentDeleteRequest $resquest, string $id)
    {
        $validated = $resquest->validated();

        $assignment = TechnicianAssignment::findOrFail($id);

        $assignment->delete();

        return $this->success(null, 200, "record deleted!");
    }
}
