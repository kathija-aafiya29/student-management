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
          @if(count($classes) >0)
            @foreach ($classes as $class)
            <div class="col-md-3 mb-4">
                <div class="card" style="width: 17rem; height: 18rem;">
                    <div class="card-body text-center">
                        <!-- Class Name -->
                        <h5 class="card-title text-primary">{{ $class->class_name }}</h5>
                        <!-- Total Students -->
                        <p class="card-text">
                            <strong>Total Students:</strong> {{ $class->total_students }}
                        </p>
                        <!-- Gender Percentage -->
                        <div class="gender-stats">
                            <p class="card-text text-success">
                                <strong>Boys:</strong> {{ $class->boys_percentage }}%
                            </p>
                            <p class="card-text text-info">
                                <strong>Girls:</strong> {{ $class->girls_percentage }}%
                            </p>
                        </div>
                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('employeesMaster.edit', $class->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit">
                                <i class="mdi mdi-table-edit"></i> Edit
                            </a>
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
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    @include('layouts.footer')
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
@endsection
@section('js')
<!-- Include Toastr -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection
