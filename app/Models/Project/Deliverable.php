<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deliverable extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];


    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_deliverables');
    }
}
