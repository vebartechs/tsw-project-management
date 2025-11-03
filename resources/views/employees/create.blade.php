@extends('layouts.app')

@section('body-space')
<div class="page-heading mb-4">
    <h3 class="text-light">Add Employee</h3>
</div>


    <div class="row ">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 bg-light">
                
                <div class="card-body p-4 ">
                    {{-- form Start --}}
                    <form class="form needs-validation" novalidate action="{{ route('employee.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $employee->id ?? null }}">

                        <div class="row g-3">
                            {{-- Name --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" name="name" maxlength="180"
                                    required value="{{ $employee->name ?? '' }}">
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="phone" pattern="[0-9]{10}"
                                    required value="{{ $employee->phone ?? '' }}">
                            </div>

                            {{-- Alternate Phone --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Alternative Number</label>
                                <input type="tel" class="form-control" name="alt_phone"
                                    pattern="[0-9]{10}" value="{{ $employee->alt_phone ?? '' }}">
                            </div>

                            {{-- Email --}}
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $employee->email ?? '' }}">
                            </div>

                            {{-- Address --}}
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Location / Address</label>
                                <input type="text" class="form-control" name="address" maxlength="250"
                                    value="{{ $employee->address ?? '' }}">
                            </div>

                            {{-- ID Proof --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ID Proof <span class="text-danger">*</span></label>
                                <select class="form-select" name="id_proof_id" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($idProofs as $idProof)
                                        <option value="{{ $idProof->id }}" {{ $idProof->id == $employee?->id_proof_id ? 'selected' : '' }}>{{ $idProof->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- ID Number --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">ID Number <span class="text-danger">*</span></label>
                                <input type="text" name="id_proof_number" class="form-control" maxlength="25" required value="{{ $employee->id_proof_number ?? '' }}">
                            </div>

                            {{-- Profession --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Profession <span class="text-danger">*</span></label>
                                <select class="form-select" name="profession_id" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}" {{ $profession->id == $employee?->profession_id ? 'selected' : '' }}>{{ $profession->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Date of Joining --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date of Joining</label>
                                <input type="date" name="date_of_joining" class="form-control" value="{{ $employee->date_of_joining ?? '' }}">
                            </div>

                            {{-- Job Type --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Job Type <span class="text-danger">*</span></label>
                                <select class="form-select" name="job_type_id" required>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($jobTypes as $jobType)
                                        <option value="{{ $jobType->id }}" {{ $jobType->id == $employee?->job_type_id ? 'selected' : '' }}>{{ $jobType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Basic Pay --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Basic Pay Per Day</label>
                                <input type="number" name="pay_per_day" class="form-control" value="{{ $employee->pay_per_day ?? '' }}">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-save me-1"></i> Save Employee
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
