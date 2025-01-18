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
                            <button data-id="{{ $employee->id }}" class="btn btn-sm btn-info delete-employee mx-1" >{{ $employee->active_status?"Inactive":"Active" }}</i></button>
                            <a href="{{ route('employeesMaster.destroy', $employee->id) }}" class="btn btn-sm btn-danger mx-1" title="Edit"><i class="mdi mdi-delete"></i></a>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle delete employee
        $('.delete-employee').click(function (e) {
            e.preventDefault();
            let employeeId = $(this).data('id');
            if (confirm('Are you sure you want to delete this employee?')) {
                $.ajax({
                    url: "{{ url('employeesMaster') }}/" + employeeId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        toastr.success('Employee deleted successfully');
                        location.reload();
                    },
                    error: function (xhr) {
                        toastr.error('Failed to delete employee');
                    }
                });
            }
        });
    });
</script>
@endsection
