<?php

namespace Modules\MaintenanceHub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\TenantHub\Models\Tenant;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MaintenanceRequest extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "tenant_id",
        "title",
        "description",
        "status",
        "priority",
        "scheduled_at",
    ];

    protected $casts = [
        "scheduled_at" => "date",
    ];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function technicians(): BelongsToMany
    {
        return $this->belongsToMany(Technician::class, 'technician_assignments')
            ->withTimestamps()
            ->withPivot('status', 'assigned_at', 'completed_at');
    }

    public function technicianAssignment(): HasMany
    {
        return $this->hasMany(TechnicianAssignment::class);
    }

    // -- accessors & mutators --
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => in_array($value, ['recieved', 'scheduled', 'repairing', 'completed', 'reshceduled']) ? $value : 'recieved',
        );
    }

    protected function priority(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => in_array($value, ['low', 'mid', 'high', 'urgent', 'ww3']) ? $value : 'mid',
        );
    }
}
