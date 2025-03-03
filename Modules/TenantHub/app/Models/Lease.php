<?php

namespace Modules\TenantHub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\TenantHub\Database\Factories\LeaseFactory;
use Modules\TenantHub\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lease extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "tenant_id",
        "lease_details",
        "deposit",
        "property_id",
        "move_in_date",
        "move_out_date",
        "monthly_rent",
    ];

    protected $casts = [
        "move_in_date" => "date",
        "move_out_date" => "date",
        "monthly_rent" => "decimal:2",
        "security_deposit" => "decimal:2",
        "lease_details" => "array"
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function property(): BelongsTo
    {
        // return $this->belongsTo(Property::class);
    }

    // protected static function newFactory(): LeaseFactory
    // {
    //     // return LeaseFactory::new();
    // }
}
