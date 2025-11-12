@extends('layouts.app')

@section('body-space')
    <div class="page-heading mb-4 d-flex justify-content-between align-items-center">
        <h3 class="text-light mb-0">Project Details</h3>
        <a href="{{ route('project.index') }}" class="btn btn-secondary">Back to Projects</a>
    </div>

    <div class="card mb-4 border">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Customer Details</h5>
                    <div class="mb-2"><strong>Name:</strong> {{ $project->customer->name }}</div>
                    <div class="mb-2"><strong>Mobile:</strong> {{ $project->customer->mobile }}</div>
                    <div class="mb-2"><strong>Email:</strong> {{ $project->customer->email }}</div>
                    <div><strong>Address:</strong> {{ $project->customer->address }}</div>
                </div>
                <div class="col-md-6">
                    <h5>Project Information</h5>
                    <div class="mb-2"><strong>Title:</strong> {{ $project->title }}</div>
                    <div class="mb-2"><strong>Status:</strong> <span class="badge bg-{{ $project->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($project->status) }}</span></div>
                    <div class="mb-2"><strong>Cost:</strong> ₹{{ number_format($project->cost, 2) }}</div>
                    <div class="mb-2"><strong>Created:</strong> {{ $project->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <!-- Coverage Details -->
            @if($project->projectdays->count() > 0)
                <div class="card mb-2 border">
                    <div class="card-header p-2 bg-light">
                        <h5 class="mb-0">Coverage Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($project->projectdays as $day)
                                <div class="col-md-12 mb-1">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <h6 class="mb-0">Day {{ $loop->iteration }}, ( {{ \Carbon\Carbon::parse($day->date)->format('d-m-Y') }} ) ( <strong>Location:</strong> {{ $day->location ?? 'N/A' }} )</h6>
                                            <div><strong>Event:</strong> {{ $day->event->name ?? 'N/A' }}</div>
                                            <div><strong>Guests:</strong> {{ $day->guests ?? '0' }}</div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                {{-- photographers --}}
                                                <div class="col-md-4">
                                                    <div><strong>Photographers:</strong> {{ $day->photographers ?? '0' }}</div>
                                                    @foreach($projectEmployeeAssignments as $projectEmployeeAssignment)
                                                        @if($projectEmployeeAssignment->project_day_id == $day->id && $projectEmployeeAssignment->work_type == 1)
                                                            <div>{{ $projectEmployeeAssignment->employee->name }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                {{-- videographers --}}
                                                <div class="col-md-4">
                                                    <div><strong>Videographers:</strong> {{ $day->videographers ?? '0' }}</div>
                                                    @foreach($projectEmployeeAssignments as $projectEmployeeAssignment)
                                                        @if($projectEmployeeAssignment->project_day_id == $day->id && $projectEmployeeAssignment->work_type == 2)
                                                            <div>
                                                                {{ $projectEmployeeAssignment->employee->name }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                {{-- drone operators --}}
                                                <div class="col-md-4">
                                                    <div><strong>Drone Operators:</strong> {{ $day->drone_operators ?? '0' }}</div>
                                                    @foreach($projectEmployeeAssignments as $projectEmployeeAssignment)
                                                        @if($projectEmployeeAssignment->project_day_id == $day->id && $projectEmployeeAssignment->work_type == 3)
                                                            <div>{{ $projectEmployeeAssignment->employee->name }}</div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Deliverables -->
            @if($project->projectdeliverables->count() > 0)
                <div class="card mb-2 border">
                    <div class="card-header p-2 bg-light">
                        <h5 class="mb-0">Deliverables</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($project->projectdeliverables as $deliverable)
                                <li class="list-group-item">{{ $deliverable->deliverable }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Complimentary -->
            <div class="card mb-4 border">
                <div class="card-header p-2 bg-light">
                    <h5 class="mb-0">Complimentary Services</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <strong>Drone:</strong> 
                                @if($project->projectcomplimentary && $project->projectcomplimentary->drones > 0)
                                    Yes ({{ $project->projectcomplimentary->drones }} drones)
                                @else
                                    No Drone
                                @endif
                            </div>
                            
                            @if($project->projectcomplimentary && $project->projectcomplimentary->pre_wedding)
                                <div class="mb-2">
                                    <strong>Pre-Wedding:</strong> Yes
                                </div>
                                <div class="mb-2">
                                    <strong>Type:</strong> {{ $project->projectcomplimentary->type ?? 'N/A' }}
                                </div>
                                <div class="mb-2">
                                    <strong>Photographers:</strong> {{ $project->projectcomplimentary->photographers ?? '0' }}
                                </div>
                                <div class="mb-2">
                                    <strong>Videographers:</strong> {{ $project->projectcomplimentary->videographers ?? '0' }}
                                </div>
                                <div class="mb-2">
                                    <strong>Location:</strong> {{ $project->projectcomplimentary->location ?? 'N/A' }}
                                </div>
                            @else
                                <div class="mb-2">
                                    <strong>Pre-Wedding:</strong> No
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <form action="{{ route('project.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Project</button>
                    
                    <a href="{{ route('project.employee.assign.create', $project->id) }}" class="btn btn-primary">Assign Employee</a>

                </form>
            </div>
        </div>
    </div>
@endsection