<?php

namespace App\Models\Project;

use App\Models\Employee\Employee;
use App\Models\Project\Project;
use App\Models\Project\ProjectDay;
use Illuminate\Database\Eloquent\Model;

class ProjectEmployeeAssignment extends Model
{
    protected $fillable = [
        'project_id',
        'project_day_id',
        'employee_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function projectDay()
    {
        return $this->belongsTo(ProjectDay::class, 'project_day_id');
    }
}
