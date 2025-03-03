<?php

namespace Modules\TenantHub\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\TenantHub\Database\Factories\TenantFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\TenantHub\Models\Lease;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "user_id",
        "status",
        "gov_id",
        "phone",
        "additional_info"
    ];

    protected $casts = [
        "additional_info" => "array",
    ];

    // -- accessors & mutators --
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => in_array($value, ['active', 'inactive', 'pending']) ? $value : 'active',
        );
    }

    // -- relations --
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leases(): HasMany
    {
        return $this->hasMany(Lease::class);
    }
}
