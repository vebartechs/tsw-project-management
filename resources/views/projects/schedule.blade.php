@extends('layouts.app')

@section('head-space')
@endsection

@section('body-space')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4 class="card-title">Monthly Schedule</h4>

                    {{-- search by mont and year  --}}
                    <form action="{{ route('project.employee.schedule') }}" method="GET" class="d-flex" style="width: 200px">
                        <input type="month" name="monthYear" class="form-control mr-sm-2" value="{{ $monthYear }}"
                            placeholder="Search by month and year">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                </div>
                <div class="col-6">

                </div>
                <div class="col align-self-end d-flex justify-content-end">

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="15%">Date</th>
                                <th>Employee</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignments as $assignment)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($assignment['date'])->format('d-m-y') }}</td>
                                    <td>
                                        @php
                                            $employees = \App\Models\Employee\Employee::whereIn('id', $assignment['employees'])->get();
                                        @endphp
                                        @foreach ($employees as $employee)
                                            <span class="">{{ $employee->name }}</span><br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
