<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectDeliverable extends Model
{
     protected $fillable = [
        'project_id',
        'deliverable',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
    
}
