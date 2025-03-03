<?php

namespace Modules\TenantHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\APIResponseTrait as ART;

class TenantHubController extends Controller
{
    use ART;
    public function tenantSummary()
    {
        // show summary of important info
        // NOTE: the data can be derived from costmer needs, this is only showcase static data
        return $this->success([
            "month_update" => [
                "new_tenats" => 50,
                "leaving_tenants" => 36
            ]
        ], 200);
    }
    public function leasesSummary()
    {
        // show summary of important info
        // NOTE: the data can be derived from costmer needs, this is only showcase static data
        return $this->success([
            "upcoming_renewals" => [
                [
                    "property_id" => "123456",
                    "remaining_days" => 60,
                ],
                [
                    "property_id" => "123456",
                    "remaining_days" => 60,
                ]
            ]
        ], 200);
    }
}
