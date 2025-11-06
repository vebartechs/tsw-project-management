@extends('layouts.app')

@section('body-space')
    <div class="page-heading mb-4 d-flex justify-content-between align-items-center">
        <h3 class="text-light mb-0">Add Project</h3>
    </div>

    <div class="row ">
        <div class=" col-md-10">
            <div class="card shadow-lg border-0 rounded-4 bg-light">

                <div class="card-body p-4 ">

                    <form id="projectForm" class="row" method="POST" action="{{ route('project.store') }}">
                        @csrf


                        <!-- Project Title -->
                        <div class="mb-3 col-md-8">
                            <label for="title" class="form-label">Project Title *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <!-- Days Input -->
                        <div class="mb-3 col-md-2">
                            <label for="daysInput" class="form-label">Number of Days*</label>
                            <input type="number" class="form-control" id="daysInput" name="days" min="1"
                                max="10" required>
                        </div>
                        <div class="mb-3 col-md-2">
                            <label for="cost" class="form-label">Cost *</label>
                            <input type="number" class="form-control" id="cost" name="cost" min="0"
                                required>
                        </div>

                        <!-- STEP 2: Dynamic day sections container -->
                        <div class="card mb-3 ">
                            <div class="card-body">
                                <h6>Coverage Details</h6>
                                <div class="row" id="daysContainer">
                                   
                                </div>

                            </div>
                        </div>

                        <!-- Deliverables Section -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6>Deliverables</h6>
                                <p>Add deliverables (choose existing or add new)</p>
                                <div id="deliverablesList">
                                    @foreach ($deliverables as $d)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="deliverables[]"
                                                value="{{ $d->id }}" id="del_{{ $d->id }}">
                                            <label class="form-check-label"
                                                for="del_{{ $d->id }}">{{ $d->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="input-group my-2">
                                    <input id="newDeliverableName" placeholder="Add new deliverable" class="form-control" />
                                    <button id="addDeliverableBtn" type="button" class="btn btn-outline-primary">Add to
                                        DB</button>
                                </div>
                            </div>
                        </div>

                        <!-- Complimentary Section -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6>Complimentary</h6>
                                <div class="mb-3">
                                    <label class="me-2">Drone Option</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="complimentary[drone_option]"
                                            value="drone">
                                        <label class="form-check-label">Drone</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="complimentary[drone_option]"
                                            value="no_drone">
                                        <label class="form-check-label">No of drone</label>
                                    </div>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="complimentary[pre_wedding]"
                                        value="1">
                                    <label class="form-check-label">Pre Wedding</label>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>Type</label>
                                        <select name="complimentary[type]" class="form-control">
                                            <option value="Photography">Photography</option>
                                            <option value="Photography + Videography">Photography + Videography</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>No of Photographer</label>
                                        <input type="number" name="complimentary[photographers]" class="form-control" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>No of Videographer</label>
                                        <input type="number" name="complimentary[videographers]" class="form-control" />
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Location</label>
                                    <select name="complimentary[location]" class="form-control">
                                        <option value="Out Station">Out Station</option>
                                        <option value="Kolkata">Kolkata</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Save Project</button>
                            </div>
                        </div>


                        <!-- Hidden container to store days data before submit -->
                        <input type="hidden" name="days_data" id="daysDataInput" />
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot-space')
    <script>
        $(function() {
            // Initialize days when the page loads
            const daysInput = $('#daysInput');

            // Build days when the input changes
            daysInput.on('keyup change', function() {
                const days = parseInt($(this).val());
                if (days && days >= 1 && days <= 10) {
                    buildDays(days);
                }
            });

            function buildDays(days) {
                const container = $('#daysContainer');
                container.empty();
                for (let i = 1; i <= days; i++) {
                    const block = $(`
                        <div class="col-6">
                        <div class="card mb-1 day-block" data-day="${i}">
                            <div class="card-body">
                                <h6>Day ${i}</h6>
                                <div class="row g-1">
                                    <div class="col-md-3 mb-1">
                                        <label>Date *</label>
                                        <input required name="day_date_${i}" class="form-control form-control-sm day-date" type="date" />
                                    </div>
                                    <div class="col-md-3 mb-1">
                                        <label>Event</label>
                                        <select class="form-control form-control-sm event-select" name="day_event_${i}">
                                            <option value="">-- Select --</option>
                                            @foreach ($events as $e)
                                            <option value="{{ $e->id }}">{{ $e->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mb-1">
                                        <label>Location</label>
                                        <input name="day_location_${i}" class="form-control form-control-sm" />
                                    </div>
                                    <div class="col-md-3 mb-1">
                                        <label>No of Guest</label>
                                        <input name="day_guests_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-4 mb-1">
                                        <label>No of Photographer</label>
                                        <input name="day_photographers_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label>No of Videographer</label>
                                        <input name="day_videographers_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                    <div class="col-md-4 mb-1">
                                        <label>No of Drone Operator</label>
                                        <input name="day_drone_${i}" class="form-control form-control-sm" type="number" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    `);
                    container.append(block);
                }
            }

            // On form submit, package days data into JSON
            $('#projectForm').on('submit', function(e) {
                const daysArr = [];
                $('.day-block').each(function() {
                    const $block = $(this);
                    daysArr.push({
                        date: $block.find('.day-date').val(),
                        event_id: $block.find('.event-select').val(),
                        location: $block.find('input[name^="day_location_"]').val(),
                        guests: $block.find('input[name^="day_guests_"]').val(),
                        photographers: $block.find('input[name^="day_photographers_"]')
                            .val(),
                        videographers: $block.find('input[name^="day_videographers_"]')
                            .val(),
                        drone_operators: $block.find('input[name^="day_drone_"]').val(),
                    });
                });
                $('#daysDataInput').val(JSON.stringify(daysArr));
            });

            // Add deliverable via AJAX
            $('#addDeliverableBtn').on('click', function() {
                const name = $('#newDeliverableName').val().trim();
                if (!name) return alert('Please enter a deliverable name');

                $.post("{{ route('project.addDeliverable') }}", {
                    _token: '{{ csrf_token() }}',
                    name: name
                }, function(response) {
                    if (response.id) {
                        $('#deliverablesList').append(
                            `<div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="deliverables[]" 
                                    value="${response.id}" 
                                    id="del_${response.id}" 
                                    checked>
                                <label class="form-check-label" for="del_${response.id}">
                                    ${response.name}
                                </label>
                            </div>`
                        );
                        $('#newDeliverableName').val('');
                    }
                }).fail(function(xhr) {
                    alert('Error adding deliverable: ' + (xhr.responseJSON?.message ||
                        'Unknown error'));
                });
            });
        });
    </script>
@endsection
