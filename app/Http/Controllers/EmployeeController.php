<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdProof;
use App\Models\Profession;
use App\Models\JobType;
use App\Models\Bloodgroup;  
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Show the employee add form.
     *
     * @return \Illuminate\View\View
     */
    public function employeeBasicForm()
    {
        $id_proof = IdProof::where('id_proof_status', 1)->get();
        $profession = Profession::where('profession_status', 1)->get();
        $job_type = JobType::where('job_type_status', 1)->get();        
        $blood_group = Bloodgroup::where('status', 1)->get();

        return view('employee.employee_add',compact('id_proof','profession','job_type','blood_group') );
    }

    public function storeEmployeeBasicForm(Request $request)
    {
        
        $request->validate([
            'employee_name' => 'required',
            'employee_phone' => 'required',
        ]);

        $employee = new Employee();
        $employee->employee_name = $request->employee_name;
        $employee->employee_phone = $request->employee_phone;
        $employee->employee_alt_phone = $request->employee_alt_phone;
        $employee->employee_email = $request->employee_email;
        $employee->employee_address = $request->employee_address;
        $employee->gender = $request->gender;
        $employee->fk_id_proof_id = $request->id_proof_id;
        $employee->id_proof_number = $request->id_proof_number;
        $employee->fk_profession_id = $request->profession_id;
        $employee->date_of_joining = $request->date_of_joining;
        $employee->blood_group_id = $request->blood_group_id;
        $employee->fk_job_type_id = $request->job_type_id;
        $employee->pay_per_day = $request->pay_per_day;
        $employee->save();  

        return redirect()->route('employee.add');       
    }
}
        