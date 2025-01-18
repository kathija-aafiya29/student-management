@extends('layouts.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> All Classes </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Classes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Classes</li>
                    </ol>
                </nav>
            </div>
            <div class="container">
                <div class="row">
                    @if (count($classes) > 0)
                        @foreach ($classes as $class)
                            <div class="col-md-3 mb-4">
                                <div class="card" style="width: 17rem; height: 18rem;">
                                    <div class="card-body text-center">
                                        <!-- Class Name -->
                                        <h5 class="card-title text-primary">{{ $class->class_name }} class
                                            {{ $class->section }}</h5>
                                        <!-- Total Students -->
                                        <p class="card-text">
                                            <strong>Total Students:</strong> {{ $class->total_students }}
                                        </p>
                                        <!-- Gender Percentage -->
                                        <div class="gender-stats">
                                            @php
                                                $totalStudents = $class->no_of_boys + $class->no_of_girls;
                                                $boysPercentage =
                                                    $totalStudents > 0
                                                        ? ($class->no_of_boys / $totalStudents) * 100
                                                        : 0;
                                                $girlsPercentage =
                                                    $totalStudents > 0
                                                        ? ($class->no_of_girls / $totalStudents) * 100
                                                        : 0;
                                            @endphp

                                            <p class="card-text text-success">
                                                <strong>Boys:</strong> {{ number_format($boysPercentage, 2) }}%
                                            </p>
                                            <p class="card-text text-info">
                                                <strong>Girls:</strong> {{ number_format($girlsPercentage, 2) }}%
                                            </p>
                                        </div>
                                        <!-- Action Buttons -->
                                        <div class="d-flex justify-content-center">

                                            <button class="btn btn-sm btn-primary mx-1 edit-class-btn" title="Edit"
                                                data-id="{{ $class->id }}" data-name="{{ $class->class_name }}"
                                                data-total="{{ $class->no_of_boys + $class->no_of_girls }}"
                                                data-boys="{{ $class->no_of_boys }}" data-girls="{{ $class->no_of_girls }}"
                                                data-bs-toggle="modal" data-bs-target="#editClassModal">
                                                <i class="mdi mdi-table-edit"></i> Edit
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 mb-4">
                            <div class="card" style=" height: 13rem;">
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    No Records Data found
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Class Modal -->
    <div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClassModalLabel">Edit Class Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editClassForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="class_id" name="class_id">

                        <div class="mb-3">
                            <label for="class_name" class="form-label">Class Name</label>
                            <input type="text" class="form-control" id="class_name" name="class_name" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="total_students" class="form-label">Total Students</label>
                            <input type="number" class="form-control" id="total_students" name="total_students" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="no_of_boys" class="form-label">No. of Boys</label>
                            <input type="number" class="form-control" id="no_of_boys" name="no_of_boys" required>
                        </div>

                        <div class="mb-3">
                            <label for="no_of_girls" class="form-label">No. of Girls</label>
                            <input type="number" class="form-control" id="no_of_girls" name="no_of_girls" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Include Toastr -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).on('click', '.edit-class-btn', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const total = $(this).data('total');
            const boys = $(this).data('boys');
            const girls = $(this).data('girls');

            $('#editClassModal input[name="class_id"]').val(id);
            $('#editClassModal input[name="class_name"]').val(name);
            $('#editClassModal input[name="total_students"]').val(total);
            $('#editClassModal input[name="no_of_boys"]').val(boys);
            $('#editClassModal input[name="no_of_girls"]').val(girls);
        });
        $('#editClassForm').submit(function(e) {
            $(this).find('.text-danger').remove(); // Remove previous error messages
            e.preventDefault(); // Prevent default form submission

            const submitButton = $('#submit-class-update'); // The submit button ID
            submitButton.prop('disabled', true); // Disable the button
            submitButton.text('Updating...'); // Indicate loading state

            let formData = new FormData(this); // Gather form data

            $.ajax({
                url: '{{ route('classes.updateClass') }}', // Replace with your class update route
                method: 'POST', // Ensure the route accepts POST for updates
                data: formData,
                processData: false, // Required for handling file uploads or FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    // Re-enable the submit button and reset its text
                    submitButton.prop('disabled', false);
                    submitButton.text('Update');

                    // Reset the form (if required, or update the form fields dynamically)
                    $('#editClassForm')[0].reset();

                    // Display success message
                    toastr.success(response.message, 'Success');

                    // Optionally, refresh the class list or redirect to another page
                    location.reload(); // Reload the page (if necessary)
                },
                error: function(xhr) {
                    // Re-enable the submit button and reset its text
                    submitButton.prop('disabled', false);
                    submitButton.text('Update');

                    if (xhr.responseJSON) {
                        const errors = xhr.responseJSON.errors || {}; // Adjust for your error structure
                        Object.keys(errors).forEach(function(key) {
                            const errorMsg = errors[key][
                            0]; // Fetch the first error message for each field
                            $(`[name="${key}"]`).after(
                                `<small class="text-danger">${errorMsg}</small>`
                                ); // Display errors below inputs
                        });
                    } else {
                        const error = xhr.responseJSON?.message || 'An unexpected error occurred.';
                        $('.errorModalMsg').text(error);
                        $('.errorModalPm').modal('show');
                        setTimeout(function() {
                            $('.errorModalPm').modal('hide');
                        }, 3000);
                    }

                    // Show general error notification
                    toastr.error('An error occurred. Please try again.', 'Error');
                },
            });
        });
    </script>
@endsection
