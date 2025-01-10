@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> All Students </h3>
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
                        <p class="card-text text-muted">{{ $student->class }}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('studentsMaster.edit', $student->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit"><i class="mdi mdi-table-edit"></i></a>
                            {{-- <button data-id="{{ $student->id }}" class="btn btn-sm btn-info delete-student mx-1" >{{ $student->active_status?"Inactive":"Active" }}</i></button> --}}
                            <a href="{{ route('studentsMaster.destroy', $student->id) }}" class="btn btn-sm btn-danger mx-1" title="Edit"><i class="mdi mdi-delete"></i></a>
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
