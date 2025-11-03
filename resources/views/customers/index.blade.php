@extends('layouts.app')


@section('head-space')

@endsection


@section('body-space')

<h2 class="text-light"></h2>

<div class="card" >
    <div class="card-header">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Customer List</h4>
            </div>
            <div class="col align-self-end d-flex justify-content-end">
                <a href="{{route('customer.create')}}" class="btn btn-primary ">Add New Customer</a>
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
                        <th>Email</th>
                        <th>Address</th>
                       
                        <th>Acation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer )

                    <tr class="{{$customer->status == 2 ? 'disable-row' :null}}">
                        <td>{{$customer->id}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->address}}</td>
                        <td>
                            <a href="{{route('customer.create',$customer->id)}}" class="btn btn-primary">Edit</a>
                            {{-- <a href="{{route('customer.destroy',$customer->id)}}" class="btn btn-danger">Delete</a> --}}
                        </td>
                        
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
       
            {{ $customers->links() }}
    </div>
</div>



{{--=================Alll Model Below this=============== --}}


<script>
    $(document).ready(function(){


    });
</script>
@endsection
{{-- -------- --}}

