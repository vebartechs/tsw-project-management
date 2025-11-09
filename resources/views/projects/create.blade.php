@extends('layouts.app')

@section('body-space')
    <div class="page-heading mb-4 d-flex justify-content-between align-items-center">
        <h3 class="text-light mb-0">Add Project</h3>
    </div>

    <div class="card mb-1 border">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 border">
                    <h6>Customer Details</h6>
                    <div>Name: {{ $customer->name }}</div>
                    <div>Mobile: {{ $customer->mobile }}</div>
                    <div>Email: {{ $customer->email }}</div>
                </div>
                <div class="col-md-6 border">
                    <div>Address: {{ $customer->address }}</div>
                </div>
            </div>

            <form id="projectForm" class="row mt-3" method="POST" action="{{ route('project.store') }}">
                @csrf

                <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                <div class="row">
                    <div class="col-md-8 mb-2">
                        <label for="title" class="form-label">Project Title *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="daysInput" class="form-label">Number of Days *</label>
                        <input type="number" class="form-control" id="daysInput" name="days" min="1"
                            max="10" required>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="cost" class="form-label">Cost *</label>
                        <input type="number" class="form-control" id="cost" name="cost" min="0" required>
                    </div>
                </div>

                <!-- STEP 2: Dynamic Day Sections -->
                <div class="card mb-3 border">
                    <div class="card-body">
                        <h6>Coverage Details</h6>
                        <div class="row" id="daysContainer"></div>
                    </div>
                </div>

                <!-- Deliverables Section -->
                <div class="card mb-3 border">
                    <div class="card-body">
                        <h6>Deliverables</h6>
                        <table id="deliverableTable" class="table table-sm align-middle mb-2">
                            @foreach ($deliverables as $deliverable)
                                <tr>
                                    <td style="width: 90%;">
                                        <input type="text" class="form-control form-control-sm" name="deliverables[]"
                                            value="{{ $deliverable->name }}">
                                    </td>
                                    <td style="width: 10%;">
                                        <button type="button" class="btn btn-danger btn-sm removeRow">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <button type="button" class="btn btn-sm btn-secondary" id="addRow">+ Add Row</button>
                    </div>
                </div>

                <!-- Complimentary Section -->
                <div class="card mb-3 border">
                    <div class="card-header border-0 pb-0">
                        <h6 class="mb-0">Complimentary</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="complimentary[drone_option]"
                                        value="no_drone" id="noDroneOption">
                                    <label class="form-check-label" for="noDroneOption">No Drone</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="complimentary[drone_option]"
                                        value="drone" id="droneOption">
                                    <label class="form-check-label" for="droneOption">Drone</label>
                                </div>
                            </div>
                            <div class="col-auto" id="drone-input" style="">

                                <input type="number" class="form-control form-control-sm" name="number_of_drones"
                                    id="number_of_drones" min="0" placeholder="Number of Drones">
                            </div>

                            {{-- Pre Wedding --}}
                            
                            <div class="col-12"></div>
                            <div class="col-md-2">
                                <input type="checkbox" class="form-check-input" name="pre_wedding"
                                    value="1" id="preWeddingCheck">
                                <label class="form-check-label" for="preWeddingCheck">Pre Wedding</label>
                            </div>
                            <div class="col-md-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-select" id="type">
                                    <option value="Photography">Photography</option>
                                    <option value="Photography + Videography">Photography + Videography</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="photographersInput" class="form-label">No of Photographer</label>
                                <input type="number" name="photographers" class="form-control"
                                    id="photographersInput">
                            </div>
                            <div class="col-md-2">
                                <label for="videographersInput" class="form-label">No of Videographer</label>
                                <input type="number" name="videographers" class="form-control"
                                    id="videographersInput">
                            </div>
                            <div class="col-md-3">
                                <label for="location" class="form-label">Location</label>
                                <select name="location" class="form-select" id="location">
                                    <option value="Out Station">Out Station</option>
                                    <option value="Kolkata">Kolkata</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Save Project</button>
                    </div>
                </div>
        </div>

        <!-- Hidden container -->
        <input type="hidden" name="days_data" id="daysDataInput" />
        </form>
    </div>
    </div>
@endsection

@section('foot-space')
    <script>
        $(function() {
            // Days dynamic builder
            $('#daysInput').on('keyup change', function() {
                const days = parseInt($(this).val());
                if (days && days >= 1 && days <= 10) buildDays(days);
            });

            function buildDays(days) {
                const container = $('#daysContainer');
                container.empty();
                for (let i = 1; i <= days; i++) {
                    const block = `
                    <div class="col-md-12">
                        <div class="card mb-2 day-block" data-day="${i}">
                            <div class="card-body">
                                <h6>Day ${i}</h6>
                                <div class="row g-2">
                                    <div class="col-md-3">
                                        <label>Date *</label>
                                        <input required name="day_date_${i}" class="form-control form-control-sm day-date" type="date" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Event</label>
                                        <select class="form-select form-select-sm event-select" name="day_event_${i}">
                                            <option value="">-- Select --</option>
                                            @foreach ($events as $e)
                                                <option value="{{ $e->id }}">{{ $e->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Location</label>
                                        <input name="day_location_${i}" class="form-control form-control-sm" type="text" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>No of Guests</label>
                                        <input name="day_guests_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                </div>
                                <div class="row g-2 mt-1">
                                    <div class="col-md-4">
                                        <label>No of Photographer</label>
                                        <input name="day_photographers_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>No of Videographer</label>
                                        <input name="day_videographers_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                    <div class="col-md-4">
                                        <label>No of Drone Operator</label>
                                        <input name="day_drone_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    container.append(block);
                }
            }

            // Before submit: collect all days
            $('#projectForm').on('submit', function() {
                const daysArr = [];
                $('.day-block').each(function() {
                    const $b = $(this);
                    daysArr.push({
                        date: $b.find('.day-date').val(),
                        event_id: $b.find('.event-select').val(),
                        location: $b.find('input[name^="day_location_"]').val(),
                        guests: $b.find('input[name^="day_guests_"]').val(),
                        photographers: $b.find('input[name^="day_photographers_"]').val(),
                        videographers: $b.find('input[name^="day_videographers_"]').val(),
                        drone_operators: $b.find('input[name^="day_drone_"]').val(),
                    });
                });
                $('#daysDataInput').val(JSON.stringify(daysArr));
            });

            // Add Deliverable Row
            $('#addRow').click(function() {
                const newRow = `
                <tr>
                    <td style="width: 90%;">
                        <input type="text" name="deliverable_name[]" class="form-control form-control-sm" required />
                    </td>
                    <td style="width: 10%;">
                        <button type="button" class="btn btn-danger btn-sm removeRow">X</button>
                    </td>
                </tr>`;
                $('#deliverableTable tbody').append(newRow);
            });

            // Remove Deliverable Row
            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
