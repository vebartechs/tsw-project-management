<?php

namespace App\Http\Controllers\Project;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Models\Employee\Employee;
use App\Models\Project\ProjectDay;
use App\Http\Controllers\Controller;
use App\Models\Project\ProjectComplimentary;
use App\Models\Project\ProjectEmployeeAssignment;

class ProjectEmployeeAssignmentController extends Controller
{
    public function create($project_id)
    {
        $project = Project::findOrFail($project_id);
        $employees = Employee::all();

        $projectEmployeeAssignments = ProjectEmployeeAssignment::where('project_id', $project_id)->get();

        return view('projects.assign-employee', compact('project', 'employees', 'projectEmployeeAssignments'));
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


        if ($request->photographers) {
            foreach ($request->photographers as $project_day_ids => $employee_ids) {


                foreach ($employee_ids as $employee_id) {
                    if ($employee_id == null) {
                        continue;
                    }
                    ProjectEmployeeAssignment::create([
                        'project_id' => $project_id,
                        'employee_id' => $employee_id,
                        'project_day_id' => $project_day_ids,
                        'work_type' => $photographer_work_type,
                    ]);
                }
            }
        }

        if ($request->videographers) {

            foreach ($request->videographers as $project_day_ids => $employee_ids) {

                foreach ($employee_ids as $employee_id) {
                    if ($employee_id == null) {
                        continue;
                    }
                    ProjectEmployeeAssignment::create([
                        'project_id' => $project_id,
                        'employee_id' => $employee_id,
                        'project_day_id' => $project_day_ids,
                        'work_type' => $videographer_work_type,
                    ]);
                }
            }
        }

        if ($request->drone_operators) {
            foreach ($request->drone_operators as $project_day_ids => $employee_ids) {

                foreach ($employee_ids as $employee_id) {
                    if ($employee_id == null) {
                        continue;
                    }
                    ProjectEmployeeAssignment::create([
                        'project_id' => $project_id,
                        'employee_id' => $employee_id,
                        'project_day_id' => $project_day_ids,
                        'work_type' => $drone_operator_work_type,
                    ]);
                }
            }
        }


        // complimentary assignments------------------------
        if ($request->complimentary_photographers) {
            foreach ($request->complimentary_photographers as $employee_id) {


                if ($employee_id == null) {
                    continue;
                }
                ProjectEmployeeAssignment::create([
                    'project_id' => $project_id,
                    'employee_id' => $employee_id,
                    'project_complimentary_id' => $project->projectcomplimentary->id,
                    'work_type' => $photographer_work_type,
                ]);
            }
        }

        if ($request->complimentary_videographers) {
            foreach ($request->complimentary_videographers as $employee_id) {


                if ($employee_id == null) {
                    continue;
                }
                ProjectEmployeeAssignment::create([
                    'project_id' => $project_id,
                    'employee_id' => $employee_id,
                    'project_complimentary_id' => $project->projectcomplimentary->id,
                    'work_type' => $videographer_work_type,
                ]);
            }
        }

        return redirect()
            ->route('project.show', $project->id)
            ->with('success', 'Employee assigned successfully');
    }

    public function schedule(Request $request)
    {
       
        $monthYear = $request->monthYear ?? date('Y-m');
        
        
        $carbonDate = Carbon::createFromFormat('Y-m', $monthYear);
        $dates = $carbonDate->daysInMonth;


        $assignments = [];
        
        foreach(range(1, $dates) as $day){
            $date = $monthYear . '-' . str_pad($day, 2, '0', STR_PAD_LEFT);
            
            $projectDays = ProjectDay::where('date', $date)->pluck('id')->toArray();
            $projectComplimentary = ProjectComplimentary::where('pre_wedding_date', $date)->pluck('id')->toArray();
            
            $assignedEmployees = ProjectEmployeeAssignment::whereIn('project_day_id', $projectDays)
                ->orWhereIn('project_complimentary_id', $projectComplimentary)
                ->pluck('employee_id')
                ->toArray();
            
            $assignments[] = [
                'date' => $date,
                'employees' => $assignedEmployees
            ];
        }
        

        return view('projects.schedule', compact('monthYear', 'assignments'));
    }



    // Ajax Already assigned employees by date
    public function alreadyAssignedEmployees(Request $request)
    {
        $date = $request->date;

        // go to project day table and get project day ids to get assigned employee list for that day
        $projectDays = ProjectDay::where('date', $date)->pluck('id')->toArray();

        //go to project compli mantory tabel to to get ids by date
        $projectComplimentary = ProjectComplimentary::where('pre_wedding_date', $date)->pluck('id')->toArray();


        //get all assigned employees
        $assignedEmployees = ProjectEmployeeAssignment::whereIn('project_day_id', $projectDays)
            ->orWhereIn('project_complimentary_id', $projectComplimentary)
            ->pluck('employee_id')
            ->toArray();

        return response()->json([
            'assigned' => $assignedEmployees,
        ]);
    }
}
