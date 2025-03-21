<?php

namespace Modules\MaintenanceHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests\MaintenanceRequestDeleteRequest;
use Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests\MaintenanceRequestShowRequest;
use Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests\MaintenanceRequestStoreRequest;
use Modules\MaintenanceHub\Http\Requests\V1\MaintenanceRequestRequests\MaintenanceRequestUpdateRequest;
use Modules\MaintenanceHub\Models\MaintenanceRequest;
use Modules\MaintenanceHub\Transformers\V1\MaintenanceRequestResource;
use Modules\TenantHub\Models\Tenant;

class MaintenanceRequestController extends Controller
{
    use APIResponseTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanceRequestStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // TODO: add functionlity by user roles of the requester
        // --- if user role is tenant ---
        // $tenant_id = auth()->user()->tenant?->id;
        // --- if user role not tenant ---
        if (isset($validated['tenant']['id'])) {
            $tenant_id = $validated['tenant']['id'];
        } elseif (isset($validated['tenant']['email'])) {
            $tenant_id = User::where('email', $validated['tenant']['email'])->firstOrfail()?->tenant?->id;
        } elseif (isset($validated['tenant']['phone'])) {
            $tenant_id = Tenant::where('phone', $validated['tenant']['phone'])->firstOrFail()?->id;
        } else {
            return $this->failed([
                'tenant' => [
                    'id' => null,
                    'phone' => null,
                    'email' => null,
                ]
            ], 400, 'tenant info not provided, please provide one of the following');
        }

        $maintenanceRequest = MaintenanceRequest::create([
            "tenant_id" => $tenant_id,
            "title" => $validated["title"],
            "description" => $validated["description"],
            "status" => $validated["status"] ?? 'recieved',
            "priority" => $validated["priority"] ?? 'mid',
            "scheduled_at" => $validated["schedule"] ?? null,
        ]);

        return $this->success(MaintenanceRequestResource::make($maintenanceRequest), 200, 'record created successfully');
    }

    /**
     * Show the resource.
     */
    public function show(MaintenanceRequestShowRequest $request, string $id = null): JsonResponse
    {
        // --- via request URL ---
        if ($id !== null) {
            $maintenanceRequest = MaintenanceRequest::findOrFail($id);
            return $this->success(MaintenanceRequestResource::make($maintenanceRequest), 200, 'record found!');
        }

        // --- via request body ---
        $validated = $request->validated();

        if (isset($validated['tenant']['id'])) {
            $tenant_id = $validated['tenant']['id'];
        } elseif (isset($validated['tenant']['email'])) {
            $tenant_id = User::where('email', $validated['tenant']['email'])->firstOrfail()?->tenant?->id;
        } elseif (isset($validated['tenant']['phone'])) {
            $tenant_id = Tenant::where('phone', $validated['tenant']['phone'])->firstOrFail()?->id;
        } else {
            return $this->failed([
                'tenant' => [
                    'id' => null,
                    'phone' => null,
                    'email' => null,
                ]
            ], 400, 'info not provided, please provide one of the following');
        }

        $maintenanceRequest = MaintenanceRequest::where('tenant_id', $tenant_id)?->get();

        return $this->success(MaintenanceRequestResource::collection($maintenanceRequest), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaintenanceRequestUpdateRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();

        $maintenanceRequest = MaintenanceRequest::findOrFail($id);

        if (isset($validated['tenant'])) {
            if (isset($validated['tenant']['id'])) {
                $validated['tenant_id'] = $validated['tenant']['id'];
            } elseif (isset($validated['tenant']['email'])) {
                $validated['tenant_id'] = User::where('email', $validated['tenant']['email'])->firstOrfail()?->tenant?->id;
            } elseif (isset($validated['tenant']['phone'])) {
                $validated['tenant_id'] = Tenant::where('phone', $validated['tenant']['phone'])->firstOrFail()?->id;
            }

            unset($validated['tenant']);
        }

        $maintenanceRequest->update($validated);

        return $this->success(MaintenanceRequestResource::make($maintenanceRequest), 200, 'maintenance request updated successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(MaintenanceRequestDeleteRequest $request, string $id): JsonResponse
    {
        $maintenanceRequest = MaintenanceRequest::findOrFail($id);

        $maintenanceRequest->delete();

        return $this->success(null, 200, 'record deleted');
    }
}
