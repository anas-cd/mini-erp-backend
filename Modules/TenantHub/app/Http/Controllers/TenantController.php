<?php

namespace Modules\TenantHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\APIResponseTrait as ART;
use Modules\TenantHub\Http\Requests\V1\TenantRequests\TenantDeleteRequest;
use Modules\TenantHub\Http\Requests\V1\TenantRequests\TenantStoreRequest;
use Modules\TenantHub\Http\Requests\V1\TenantRequests\TenantUpdateRequest;
use Modules\TenantHub\Models\Tenant;
use Modules\TenantHub\Transformers\V1\TenantResource;

class TenantController extends Controller
{
    use ART;

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenantStoreRequest $request)
    {
        $validated = $request->validated();

        $tenant = Tenant::create([
            'user_id' => isset($validated['user_email']) ? User::where('email', $validated['email'])->get()->first() : auth()->id(),
            'status' => $validated['status'],
            'gov_id' => $validated['gov_id'],
            'additional_info' => $validated['additional_info'],
            'phone' => $validated['phone'],
        ]);

        return $this->success(TenantResource::make($tenant), 200, 'tenant created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show($id = null)
    {
        $tenant = Tenant::findOrFail($id ?? auth()->id());
        return $this->success(TenantResource::make($tenant));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenantUpdateRequest $request, string $id)
    {
        $tenant = Tenant::findOrFail($id);

        $validated = $request->validated();

        $tenant->update($validated);

        return $this->success(TenantResource::make($tenant), 200, 'tenant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TenantDeleteRequest $request, string $id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return $this->success([], 200, 'tenant record deleted successfully');
    }
}
