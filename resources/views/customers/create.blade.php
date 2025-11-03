@extends('layouts.app')

@section('body-space')
<div class="page-heading mb-4">
    <h3 class="text-light">@if($customer->id)Edit Customer @else Add Customer @endif</h3>
</div>


    <div class="row ">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 bg-light">
                
                <div class="card-body p-4 ">
                    {{-- form Start --}}
                    <form class="form needs-validation" novalidate action="{{ route('customer.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $customer->id ?? null }}">

                        <div class="row g-3">
                            {{-- Name --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="name" maxlength="180"
                                    required value="{{ $customer->name ?? '' }}">
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" pattern="[0-9]{10}"
                                    required value="{{ $customer->phone ?? '' }}">
                            </div>

                            {{-- Alternate Phone --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Alternative Number</label>
                                <input type="tel" class="form-control" name="alt_phone"
                                    pattern="[0-9]{10}" value="{{ $customer->alt_phone ?? '' }}">
                            </div>

                            {{-- Email --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $customer->email ?? '' }}">
                            </div>

                            {{-- Address --}}
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Location / Address</label>
                                <input type="text" class="form-control" name="address" maxlength="250"
                                    value="{{ $customer->address ?? '' }}">
                            </div>

                          


                            
                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-save me-1"></i> @if($customer->id)Update Customer @else Save Customer @endif
                            </button>
                        </div>
                    </form>
                    {{-- form End --}}
                </div>
            </div>
        </div>


{{-- Optional JS --}}
<script>
    // Disable back navigation
    $(document).ready(function () {
        window.history.go(1);
    });
</script>
@endsection
