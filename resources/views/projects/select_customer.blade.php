@extends('layouts.app')

@section('body-space')
    <h5 class="card-title text-white">Create Project</h5>

    <div class="card" style="max-width: 1000px">

        <div class="card-content">

            <div class="card-body">
                <div class="container mt-1 mb-3">
                    <h6>Select Customer to Create Project</h6>
                    <div class="mt-3">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control" placeholder="Type customer name...">
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $("#customer_name").autocomplete({
                            source: "{{ route('customer.searchCustomer') }}",
                            minLength: 1,
                            select: function(event, ui) {
                                window.location.href = "/project/create/" + ui.item.id;
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
