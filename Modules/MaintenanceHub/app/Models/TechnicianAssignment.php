<?php

namespace Modules\MaintenanceHub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TechnicianAssignment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "maintenance_request_id",
        "technician_id",
        "status",
        "task",
        "assigned_at",
        "completed_at"
    ];

    protected $casts = [
        "assigned_at" => "date",
        "completed_at" => "date",
    ];

    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }

    public function maintenanceRequest(): BelongsTo
    {
        return $this->belongsTo(MaintenanceRequest::class);
    }

    // -- accessors & mutators --
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn(string|null $value) => in_array($value, ['assigned', 'scheduled', 'progress', 'completed']) ? $value : 'assigned',
        );
    }
}
