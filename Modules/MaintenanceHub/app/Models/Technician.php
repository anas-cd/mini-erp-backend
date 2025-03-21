<?php

namespace Modules\MaintenanceHub\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Technician extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "specialization",
        "status",
        "name",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(TechnicianAssignment::class);
    }

    public function maintenanceRequests(): BelongsToMany
    {
        return $this->belongsToMany(MaintenanceRequest::class, "technician_assignments")
            ->withTimestamps()
            ->withPivot('status', 'assigned_at', 'completed_at');
    }

    // -- accessors & mutators --
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => in_array($value, ['active', 'inactive', 'leave']) ? $value : 'active',
        );
    }
}
