<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectDay extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'project_id',
        'day_index', 
        'date', 'event_id', 
        'location',
        'guests',
        'photographers', 
        'videographers', 
        'drone_operators'];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
