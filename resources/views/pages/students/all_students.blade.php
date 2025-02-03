@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color">
      <h4 class="page-title"> All Students </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Students</a></li>
          <li class="breadcrumb-item active" aria-current="page">New Students</li>
        </ol>
      </nav>
    </div>
      <div class="container">
        <div class="row">
          @if(count($students) >0)
            @foreach ($students as $student)
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 15rem; height: 13rem;">
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <img src="{{ $student->profile_picture ? asset('storage/profiles/' . $student->profile_picture) : asset('assets/profiles/default_profile.png') }}" 
                            class="card-img-top rounded-circle" 
                            alt="{{ $student->student_name }}" 
                            style="height: 40px; width: 40px;">
                    </div>
                    <div class="card-body text-center">
                        <h6>{{ $student->student_name }}</h6>
                        <p class="card-text text-muted">{{ $student->class_name }}</p>
                        <div class="d-flex justify-content-center">
                          <a href="{{ route('studentsMaster.edit', $student->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit"><i class="mdi mdi-table-edit"></i></a>
                            <button data-id="{{ $student->id }}" class="btn btn-sm toggle-status {{ $student->active_status ? "btn-secondary":"btn-info" }}  mx-1" >
                              {{ $student->active_status?"InActive":"Active" }}</button>
                            <button class="btn btn-sm btn-danger delete-student mx-1" title="delete"  data-id="{{ $student->id }}"><i class="mdi mdi-delete"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-md-12 mb-4">
              <div class="card" style="height: 13rem;">
                  <div class="d-flex justify-content-center align-items-center mt-3">
                      No Data found
                  </div>
              </div>
            </div>
            @endif 

        </div>
      </div>
  
  </div>
</div>
@endsection
@section('js')
<!-- Include Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Handle status toggle
        $('.toggle-status').click(function (e) {
            e.preventDefault();
            let button = $(this);
            let studentId = button.data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to change the Student's status?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Change it!",
                cancelButtonText: "No, Cancel",
                width: "350px",  
                heightAuto: false,
                customClass: {
                    popup: "small-swal"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('studentsMaster') }}/" + studentId + "/toggle-status",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function () {
                            Swal.fire("Updated!", "Student status has been changed.", "success").then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire("Error!", "Failed to update status.", "error");
                        }
                    });
                }
            });
        });

        // Handle delete employee
        $('.delete-student').click(function (e) {
            e.preventDefault();
            let studentId = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, Delete it!",
                cancelButtonText: "No, Cancel",
                width: "350px",  
                heightAuto: false,
                customClass: {
                    popup: "small-swal"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('studentsMaster') }}/" + studentId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function () {
                            Swal.fire("Deleted!", "Student has been removed.", "success").then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire("Error!", "Failed to delete Student.", "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
