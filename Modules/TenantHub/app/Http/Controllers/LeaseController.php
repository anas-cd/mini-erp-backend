<?php

namespace Modules\TenantHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\TenantHub\Http\Requests\V1\LeaseRequests\LeaseShowRequest;
use Modules\TenantHub\Http\Requests\V1\LeaseRequests\LeaseStoreRequest;
use Modules\TenantHub\Http\Requests\V1\LeaseRequests\LeaseUpdateRequest;
use Modules\TenantHub\Models\Lease;
use App\Traits\APIResponseTrait as ART;
use Modules\TenantHub\Transformers\V1\LeaseResource;

class LeaseController extends Controller
{
    use ART;
    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaseStoreRequest $request)
    {
        $validated = $request->validated();

        $user = User::where("email", $validated["tenant_email"])->first();

        if ($user) {
            $lease = Lease::create([
                "tenant_id" => $user->tenant->id,
                "lease_details" => $validated["lease_details"],
                "property_id" => $validated["property_id"],
                "deposit" => $validated["deposit"],
                "monthly_rent" => $validated["monthly_rent"],
                "move_in_date" => now(),
                "move_out_date" => now()->addYear(),
            ]);

            return $this->success(LeaseResource::make($lease), 200, "lease created successfully");

        } else {
            return $this->failed([], 404, "no such user with email: " . $validated["tenant_email"] . ".");
        }
    }

    /**
     * Show the specified resource.
     */
    public function show(LeaseShowRequest $request, string $id = null)
    {
        $validated = $request->validated();

        if ($id == null) {
            if (isset($validated["property_id"])) {
                $lease = Lease::where("property_id", $validated["property_id"])->firstOrFail();

            } elseif (isset($validated["tenant_email"])) {

                $lease = User::with("tenant.leases")->where("email", $validated["tenant_email"])->firstOrFail()?->tenant?->leases;

                return $this->success(LeaseResource::collection($lease), 200);

            } else {
                return $this->failed([], 400, "please specify lease id on query or any of ['tenant_id', property_id] in request body");
            }

        } else {
            $lease = Lease::findOrFail($id);
        }

        return $this->success(LeaseResource::make($lease), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaseUpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $lease = Lease::findOrFail($id);

        $lease->update($validated);

        return $this->success(LeaseResource::make($lease), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $lease = Lease::findOrFail($id);
        $lease->delete();

        return $this->success([], 200, 'lease record deleted');
    }
}
