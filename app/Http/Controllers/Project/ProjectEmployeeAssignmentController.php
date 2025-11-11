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

    public function store(Request $request)
    {
        // dd($request->all());

        //work type
        $photographer_work_type = 1;
        $videographer_work_type = 2;
        $drone_operator_work_type = 3;

        $project_id = $request->project_id;
       

        $project = Project::findOrFail($project_id);

        // delete previous assignments
        ProjectEmployeeAssignment::where('project_id', $project_id)->delete();
        

        
        foreach ($request->photographers as $project_day_ids=>$employee_ids) {


           foreach ($employee_ids as $employee_id) {
            ProjectEmployeeAssignment::create([
                'project_id' => $project_id,
                'employee_id' => $employee_id,
                'project_day_id' => $project_day_ids,
                'work_type' => $photographer_work_type,
            ]);
           }
                
            
        }

        foreach ($request->videographers as $project_day_ids=>$employee_ids) {

           foreach ($employee_ids as $employee_id) {
            ProjectEmployeeAssignment::create([
                'project_id' => $project_id,
                'employee_id' => $employee_id,
                'project_day_id' => $project_day_ids,
                'work_type' => $videographer_work_type,
            ]);
           }
                
            
        }

        foreach ($request->drone_operators as $project_day_ids=>$employee_ids) {

           foreach ($employee_ids as $employee_id) {
            ProjectEmployeeAssignment::create([
                'project_id' => $project_id,
                'employee_id' => $employee_id,
                'project_day_id' => $project_day_ids,
                'work_type' => $drone_operator_work_type,
            ]);
           }
                
            
        }

        return redirect()
            ->route('project.show', $project->id)
            ->with('success', 'Employee assigned successfully');
    }
}
