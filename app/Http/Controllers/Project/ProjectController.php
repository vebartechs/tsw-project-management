<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Project;
use App\Models\Project\Event;
use App\Models\Project\Deliverable;
use App\Models\Project\ProjectDay;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('name')->get();
        $deliverables = Deliverable::orderBy('name')->get();
        $project->load('days', 'deliverables');
        return view('projects.edit', compact('project', 'events', 'deliverables'));
    }


    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'days' => 'required|integer|min:1|max:10',
        ]);


        DB::transaction(function () use ($request, $project) {
            $project->update([
                'title' => $request->title,
                'cost' => $request->cost,
                'days' => $request->days,
                'complimentary' => $request->complimentary ?? null,
            ]);


            // sync days: simple approach - remove existing and recreate
            $project->days()->delete();
            if ($request->has('days_data')) {
                foreach ($request->days_data as $idx => $day) {
                    ProjectDay::create([
                        'project_id' => $project->id,
                        'day_index' => $idx + 1,
                        'date' => $day['date'],
                        'event_id' => $day['event_id'] ?: null,
                        'location' => $day['location'] ?: null,
                        'guests' => $day['guests'] ?: null,
                        'photographers' => $day['photographers'] ?: 0,
                        'videographers' => $day['videographers'] ?: 0,
                        'drone_operators' => $day['drone_operators'] ?: 0,
                    ]);
                }
            }


            // sync deliverables
            $project->deliverables()->sync($request->deliverables ?: []);
        });


        return redirect()->route('projects.index')->with('success', 'Project updated');
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
