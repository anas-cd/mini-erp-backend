<?php

namespace Modules\MaintenanceHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests\TechnicianDeleteRequest;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests\TechnicianShowRequest;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests\TechnicianStoreRequest;
use App\Traits\APIResponseTrait;
use Modules\MaintenanceHub\Http\Requests\V1\TechnicianRequests\TechnicianUpdateRequest;
use Modules\MaintenanceHub\Models\Technician;
use Modules\MaintenanceHub\Transformers\V1\TechnicianResource;

class TechnicianController extends Controller
{
    use APIResponseTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(TechnicianStoreRequest $request)
    {
        $validated = $request->validated();

        // -- finding user_id --
        $user = User::where("email", $validated["user"]["email"])->first();
        if (!$user)
            return $this->failed(null, 404, 'no user found with this email, please register user first');

        $validated['user_id'] = $user->id;
        unset($validated["user"]);
        $technician = Technician::create($validated);

        return $this->success(TechnicianResource::make($technician), 200, 'record created successfuly');
    }

    /**
     * Show the specified resource.
     */
    public function show(TechnicianShowRequest $request, string $id = null)
    {
        if ($id !== null) {
            $technician = Technician::findOrFail($id);
            return $this->success(TechnicianResource::make($technician), 200);
        }

        $validated = $request->validated();
        if (isset($validated['email'])) {
            $technician = User::where('email', $validated['email'])->firstOrFail()?->technician;
            return $this->success(TechnicianResource::make($technician), 200);
        } elseif (isset($validated['name'])) {
            $technician = Technician::where('name', $validated['name'])->firstOrFail();
            return $this->success(TechnicianResource::make($technician), 200);
        } else {
            return $this->failed(null, 400, 'please provide the technician email or name in the request body, or specify the ID in URL');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TechnicianUpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $technician = Technician::findOrFail($id);

        $technician->update($validated);

        return $this->success(TechnicianResource::make($technician), 200, 'record updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TechnicianDeleteRequest $request, string $id)
    {
        $technician = Technician::findOrFail($id);
        $technician->delete();
        return $this->success(null, 200, 'record deleted');
    }
}
