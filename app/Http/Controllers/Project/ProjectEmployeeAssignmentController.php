<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Models\Employee\Employee; 
use App\Models\Project\ProjectEmployeeAssignment;
use Carbon\Carbon;        

class ProjectEmployeeAssignmentController extends Controller
{
    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        $employees = Employee::all();

        return view('projects.assign-employee', compact('project', 'employees'));
    }

    public function store(Request $request, $project_id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'days' => 'required|array|min:1',
            'days.*' => 'date',
        ]);

        $project = Project::findOrFail($project_id);
        
        foreach ($request->days as $day) {
            // Check if assignment already exists
            $exists = ProjectEmployeeAssignment::where('project_id', $project_id)
                ->where('employee_id', $request->employee_id)
                ->whereDate('assigned_date', $day)
                ->exists();

            if (!$exists) {
                ProjectEmployeeAssignment::create([
                    'project_id' => $project_id,
                    'employee_id' => $request->employee_id,
                    'assigned_date' => $day,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()
            ->route('projects.employees.assign', $project_id)
            ->with('success', 'Employee assigned successfully');
    }
}
