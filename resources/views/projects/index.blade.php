@extends('layouts.app')


@section('head-space')

@endsection


@section('body-space')

<h2 class="text-light"></h2>

<div class="card" >
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Project List</h4>
            </div>
            <div class="col align-self-end d-flex justify-content-end">
                <a href="{{route('project.selectCustomer')}}" class="btn btn-primary ">Add New Project</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Title</th>
                        <th>Cost</th>
                        <th>Days</th>
                        <th>Acation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project )

                    <tr class="{{$project->status == 2 ? 'disable-row' :null}}">
                        <td>{{$project->id}}</td>
                        <td>{{$project->customer->name}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->cost}}</td>
                        <td>{{$project->days}}</td>
                        <td>
                        <td>
                            <a href="{{route('project.show',$project->id)}}" class="btn btn-primary">View</a>
                            {{-- <a href="{{route('project.create',$project->id)}}" class="btn btn-primary">Edit</a> --}}
                            {{-- <a href="{{route('project.destroy',$project->id)}}" class="btn btn-danger">Delete</a> --}}
                        </td>
                        
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
       
            {{ $projects->links() }}
    </div>
</div>



{{--=================Alll Model Below this=============== --}}


<script>
    $(document).ready(function(){


    });
</script>
@endsection
{{-- -------- --}}

