@extends('layouts.app')

@section('body-space')


    <div class="page-heading mb-4 d-flex justify-content-between align-items-center">
        <h3 class="text-light mb-0">Assign Employee</h3>
        <a href="{{ route('project.show', $project->id) }}" class="btn btn-secondary">Back to Project</a>
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
                    <div class="mb-2"><strong>Status:</strong> <span
                            class="badge bg-{{ $project->status === 'active' ? 'success' : 'secondary' }}">{{ ucfirst($project->status) }}</span>
                    </div>
                    <div class="mb-2"><strong>Cost:</strong> ₹{{ number_format($project->cost, 2) }}</div>
                    <div class="mb-2"><strong>Created:</strong> {{ $project->created_at->format('M d, Y') }}</div>
                </div>
            </div>

            <form action="{{ route('project.employee.assign.store') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="project_id" value="{{ $project->id }}">
            <!-- Coverage Details -->
            @if ($project->projectdays->count() > 0)
                <div class="card mb-4 border">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Coverage Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($project->projectdays as $day)
                                <div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Day {{ $loop->iteration }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div><strong>Date:</strong>
                                                        {{ \Carbon\Carbon::parse($day->date)->format('M d, Y') }}</div>
                                                    <div><strong>Event:</strong> {{ $day->event->name ?? 'N/A' }}</div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div><strong>Location:</strong> {{ $day->location ?? 'N/A' }}</div>
                                                    <div><strong>Guests:</strong> {{ $day->guests ?? '0' }}</div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div><strong>Photographers:</strong> {{ $day->photographers ?? '0' }}
                                                    </div>
                                                    @if ($day->photographers > 0)
                                                        @for ($i = 1; $i <= $day->photographers; $i++)
                                                            {{-- select employee --}}
                                                            <select name="photographers[]" class="form-select">
                                                                <option value="">Select Employee</option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{ $employee->id }}">
                                                                        {{ $employee->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endfor
                                                    @endif

                                                     <div><strong>Videographers:</strong> {{ $day->videographers ?? '0' }}</div>
                                                     @if ($day->videographers > 0)
                                                     @for($i = 1; $i <= $day->videographers; $i++)
                                                     {{-- select employee --}}
                                                     <select name="videographers[]" class="form-select">
                                                         <option value="">Select Employee</option>
                                                         @foreach($employees as $employee)
                                                             <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                         @endforeach
                                                     </select>  
                                                     @endfor
                                                     @endif

                                                </div>
                                                <div class="col-md-3">
                                                    <div><strong>Drone Operators:</strong>
                                                        {{ $day->drone_operators ?? '0' }}</div>
                                                    @if ($day->drone_operators > 0)
                                                        @for ($i = 1; $i <= $day->drone_operators; $i++)
                                                            {{-- select employee --}}
                                                            <select name="drone_operators[]" class="form-select">
                                                                <option value="">Select Employee</option>
                                                                @foreach ($employees as $employee)
                                                                    <option value="{{ $employee->id }}">
                                                                        {{ $employee->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        @endfor
                                                    @endif
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
        @endsection
