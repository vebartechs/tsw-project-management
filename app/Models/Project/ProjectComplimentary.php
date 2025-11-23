<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectComplimentary extends Model
{
     protected $fillable = [
        'project_id',
        'drones',
        'pre_wedding',
        'pre_wedding_date',
        'type',
        'photographers',
        'videographers',
        'location',
    ];

    /**
     * Relationship: Each complimentary record belongs to a project.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

}