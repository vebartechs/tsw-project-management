@extends('layouts.app')


@section('head-space')
<style>

    .disable-row{
        background-color:#b7b7b7; 
    }
</style>
@endsection


@section('body-space')

<h2 class="text-light"></h2>

<div class="card" >
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Employee List</h4>
            </div>
            <div class="col align-self-end d-flex justify-content-end">
                <a href="{{route('employee.create')}}" class="btn btn-primary ">Add New Employee</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>Phone Number</th>
                        <th>Profession</th>
                        <th>Job Type</th>
                        <th>Joining Date</th>
                        <th>Acation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee )

                    <tr class="{{$employee->status == 2 ? 'disable-row' :null}}">
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->name}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->profession->name}}</td>
                        <td>{{$employee->jobType->name}}</td>
                        <td>{{$employee->date_of_joining}}</td>
                        <td>
                            <a href="{{route('employee.create',$employee->id)}}" class="btn btn-primary">Edit</a>
                            {{-- <a href="{{route('employee.destroy',$employee->id)}}" class="btn btn-danger">Delete</a> --}}
                        </td>
                        
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
       
            {{ $employees->links() }}
    </div>
</div>



{{--=================Alll Model Below this=============== --}}


<script>
    $(document).ready(function(){


    });
</script>
@endsection
{{-- -------- --}}

