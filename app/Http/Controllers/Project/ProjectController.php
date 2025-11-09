<?php

namespace App\Http\Controllers\Project;

use Illuminate\Http\Request;
use App\Models\Project\Event;
use App\Models\Project\Project;
use App\Models\Customer\Customer;
use App\Models\Project\ProjectDay;
use App\Models\Project\Deliverable;
use App\Http\Controllers\Controller;
use App\Models\Project\ProjectDeliverable;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('id','desc')->paginate(12);
        return view('projects.index', compact('projects'));
    }

    // select customer
    public function selectCustomer()
    {
        return view('projects.select_customer');
    }


    public function create($customer_id,$project_id=null)
    {
        $customer = Customer::find($customer_id);
        $events = Event::orderBy('name')->get();
        $deliverables = Deliverable::orderBy('name')->get();
        return view('projects.create', compact('events', 'deliverables','customer'));
    }


     public function store(Request $request)
    {
        // ✅ Step 1: Validate input
        $request->validate([
            'title'     => 'required|string|max:255',
            'days'      => 'required|integer|min:1|max:10',
            'days_data' => 'required|string',
        ]);

        // ✅ Step 2: Create Project
        $project = Project::create([
            'customer_id'      => $request->customer_id ?? null,
            'title'            => $request->title,
            'days'             => $request->days,
            'cost'             => $request->cost,
        ]);

        // ✅ Step 3: Save Deliverables using relationship
        if ($request->filled('deliverables')) {
            foreach ($request->deliverables as $deliverableName) {
                if ($deliverableName) {
                   ProjectDeliverable::create([
                        'project_id' => $project->id,
                        'deliverable' => $deliverableName,
                    ]);
                }
            }
        }

        // Project complimentary
        $project->projectComplimentary()->create([
            'project_id' => $project->id,
            'drones' => $request->number_of_drones,
            'pre_wedding' => $request->pre_wedding,
            'type' => $request->type,
            'photographers' => $request->photographers,
            'videographers' => $request->videographers,
            'location' => $request->location,
        ]);


        // ✅ Step 4: Save Days using relationship
        $daysData = json_decode($request->days_data, true);
        if (is_array($daysData)) {
            foreach ($daysData as $index => $day) {
                $project->projectdays()->create([
                    'day_number'      => $index + 1,
                    'date'            => $day['date'] ?? null,
                    'event_id'        => $day['event_id'] ?? null,
                    'location'        => $day['location'] ?? null,
                    'guests'          => $day['guests'] ?? null,
                    'photographers'   => $day['photographers'] ?? null,
                    'videographers'   => $day['videographers'] ?? null,
                    'drone_operators' => $day['drone_operators'] ?? null,
                ]);
            }
        }

        // ✅ Step 5: Redirect
        return redirect()
            ->route('project.index')
            ->with('success', 'Project created successfully!');
    }

    public function show($id)
    {
        $project = Project::find($id);
        return view('projects.show', compact('project'));
    }


    public function destroy(Project $project)
    {
        $project->delete(); // soft delete
        return redirect()->route('projects.index')->with('success', 'Project deleted (soft)');
    }


    // AJAX endpoints to add Event or Deliverable from UI
    public function addEvent(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $event = Event::create(['name' => $request->name]);
        return response()->json($event);
    }


    public function addDeliverable(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $d = Deliverable::create(['name' => $request->name]);
        return response()->json($d);
    }
}
