<?php

namespace Modules\TenantHub\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\APIResponseTrait as ART;

class TenantHubController extends Controller
{
    use ART;
    public function summary()
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
}
