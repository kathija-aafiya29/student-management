@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color d-flex justify-content-between align-items-center">
        <div>
            <h4 class="page-title">All Students</h4>
            
        </div>
        <div class="search-bar">
            <div class="input-group">
                <input type="text" id="searchStudent" class="form-control" placeholder="Search Students...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                        <i class="mdi mdi-close"></i> <!-- Close icon -->
                    </button>
                </div>
            </div>
        </div>
    </div>
      
      <div class="container"  id="studentContainer" >
        <div class="row">
          @if(count($students) >0)
          @foreach ($students as $student)
          <div class="col-md-3 mb-4 student-card" 
               data-name="{{ strtolower($student->student_name) }}" 
               data-class="{{ strtolower($student->class_name) }}">
            <div class="card" style="width: 17rem; height: 15rem;">
              <div class="d-flex justify-content-center align-items-center mt-3">
                <img src="{{ $student->profile_picture ? asset('storage/profiles/' . $student->profile_picture) : asset('assets/profiles/default_profile.png') }}" 
                    class="card-img-top rounded-circle" 
                    alt="{{ $student->student_name }}" 
                    style="height: 60px; width: 60px;">
              </div>
              <div class="card-body text-center">
                <h6>{{ $student->student_name }}</h6>
                <p class="card-text text-muted">{{ $student->class_name }}</p>
                <div class="d-flex justify-content-center">
                  <a href="{{ route('studentsMaster.edit', $student->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit">
                    <i class="mdi mdi-table-edit"></i>
                  </a>
                  <button data-id="{{ $student->id }}" class="btn btn-sm toggle-status {{ $student->active_status ? "btn-secondary":"btn-info" }}  mx-1">
                    {{ $student->active_status ? "InActive" : "Active" }}
                  </button>
                  <button class="btn btn-sm btn-danger delete-student mx-1" title="Delete" data-id="{{ $student->id }}">
                    <i class="mdi mdi-delete"></i>
                  </button>
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
          <div class="col-md-12 mb-4" id="noDataCard" style="display: none;">
            <div class="card" style="height: 13rem;">
                <div class="d-flex justify-content-center align-items-center mt-3">
                    No Data found
                </div>
            </div>
          </div>
        </div>
      </div>
  
  </div>
</div>
@endsection
@section('js')
<!-- Include Toastr -->


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
        $("#searchStudent").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        let visibleCount = 0;

        $(".student-card").each(function () {
            let name = $(this).data("name");
            let className = $(this).data("class");

            if (name.includes(value) || className.includes(value)) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });

        // Show "No Data Found" if no students match
        $("#noDataCard").toggle(visibleCount === 0);

        // Show/hide clear button
        $("#clearSearch").toggle($(this).val().length > 0);
    });

    // Clear search input
    $("#clearSearch").click(function () {
        $("#searchStudent").val("").trigger("keyup");
        $(this).hide();
    });
    $("#clearSearch").hide();

    });
</script>
@endsection
