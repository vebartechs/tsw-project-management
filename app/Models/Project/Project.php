<?php

namespace App\Models\Project;

use App\Models\Project\ProjectDay;
use App\Models\Project\Deliverable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'title',
        'cost',
        'days',
        'complimentary'
    ];


    protected $casts = [
        'complimentary' => 'array',
    ];



    // relationship
    public function days(): HasMany
    {
        return $this->hasMany(ProjectDay::class);
    }


    public function deliverables(): BelongsToMany
    {
        return $this->belongsToMany(Deliverable::class, 'project_deliverables');
    }
}
