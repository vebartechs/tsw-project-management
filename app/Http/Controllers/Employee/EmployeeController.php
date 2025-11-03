<?php

namespace App\Http\Controllers\Employee;

use App\Models\Other\IdProof;
use App\Models\Other\Profession;
use App\Models\Other\JobType;
use App\Models\Other\BloodGroup;
use Illuminate\Http\Request;    
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create(int $id = null)
    {
        $idProofs = IdProof::all();
        $professions = Profession::all();
        $jobTypes = JobType::all();
        $bloodGroups = BloodGroup::all();
        $employee = Employee::find($id);
        return view('employees.create', compact('idProofs', 'professions', 'jobTypes', 'bloodGroups','employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable|email',
            'date_of_joining' => 'nullable|date',
        ]);

        $employee = Employee::updateOrCreate(['id' => $request->id], $request->all());

        return redirect()->route('employee.index')->with('success', 'Employee added successfully.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }


}
