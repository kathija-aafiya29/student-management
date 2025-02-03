@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color">
      <h4 class="page-title"> All Employees </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">New Employee</li>
        </ol>
      </nav>
    </div>
      <div class="container">
        <div class="row">
          @if(count($employees) >0)
            @foreach ($employees as $employee)
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 17rem; height: 15rem;">
                    <div class="d-flex justify-content-center align-items-center mt-3">
                        <img src="{{ $employee->profile_picture ? asset('storage/profiles/' . $employee->profile_picture) : asset('assets/profiles/default_profile.png') }}" 
                            class="card-img-top rounded-circle" 
                            alt="{{ $employee->employee_name }}" 
                            style="height: 60px; width: 60px;">
                    </div>
                    <div class="card-body text-center">
                        <h6>{{ $employee->employee_name }}</h6>
                        <p class="card-text text-muted">{{ $employee->employee_role }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('employeesMaster.edit', $employee->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit"><i class="mdi mdi-table-edit"></i></a>
                            <button data-id="{{ $employee->id }}" class="btn btn-sm toggle-status {{ $employee->active_status ? "btn-secondary":"btn-info" }}  mx-1" >
                              {{ $employee->active_status?"InActive":"Active" }}</button>
                            <button class="btn btn-sm btn-danger delete-employee mx-1" title="delete"  data-id="{{ $employee->id }}"><i class="mdi mdi-delete"></i></a>
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
@endsection
@section('js')
<!-- Include Toastr -->

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        // Handle status toggle
        $('.toggle-status').click(function (e) {
            e.preventDefault();
            let button = $(this);
            let employeeId = button.data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to change the employee's status?",
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
                        url: "{{ url('employeesMaster') }}/" + employeeId + "/toggle-status",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function () {
                            Swal.fire("Updated!", "Employee status has been changed.", "success").then(() => {
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
        $('.delete-employee').click(function (e) {
            e.preventDefault();
            let employeeId = $(this).data('id');

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
                        url: "{{ url('employeesMaster') }}/" + employeeId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function () {
                            Swal.fire("Deleted!", "Employee has been removed.", "success").then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire("Error!", "Failed to delete employee.", "error");
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
