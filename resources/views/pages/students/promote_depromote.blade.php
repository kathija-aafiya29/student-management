@extends('layouts.layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header header-card-color">
                <h4 class="page-title">Promote De-Promote students </h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Students</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Students</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                              <div class=" mb-2 col-md-9">
                                <h4 class="card-title">Student List</h4>
                                 
                              </div>
                              <div class="col-md-3">
                                <select id="classFilter" class="form-control  form-select">
                                    <option value="" selected>Choose Class</option>
                                    <option value="">All Classes</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                             </div>

                            </div>
                            <!-- Student Table -->
                            <table id="studentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Promote/De-Promote</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Grade Modal -->
    <div class="modal fade" id="gradingModal" tabindex="-1" aria-labelledby="gradingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gradingModalLabel">Add/Edit Grade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="gradingForm">
                        @csrf
                        <input type="hidden" id="gradingId">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="grade">Grade</label>
                              <input type="text" class="form-control" id="grade" name="grade">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="from" class="form-label">From</label>
                              <input type="number" class="form-control" id="from" name="from">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="to" class="form-label">Upto</label>
                              <input type="number" class="form-control" id="to" name="to">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="status" class="form-label">Status</label>
                              <select class="form-control form-control-sm form-select" id="status" name="status">
                                  <option value="">Select Status</option>
                                  <option value="1">Pass</option>
                                  <option value="0">Fail</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                          </div>
                          <div class="col-md-2"> <button type="submit" class="btn btn-primary btn-sm " id="#update-form">Save</button></div>
                            <div class="col-md-5"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            loadTable();
        });

        function loadTable() {
            $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true, // Reload DataTable properly
                ajax: {
                    url: "{{ route('students.promoteDepromote') }}",
                    data: function (d) {
                        d.class_id = $('#classFilter').val(); // Send selected class ID
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'student_name', name: 'student_name' },
                    { data: 'class_name', name: 'class_name' },
                    { data: 'promotion', name: 'promotion' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        }
        function submitPromotion(id) {
          var status = $('#promotion_' + id).val(); // Get selected value

          $.ajax({
              url: "{{ route('students.updatePromotion') }}",
              type: "POST",
              data: {
                  _token: "{{ csrf_token() }}",
                  id: id,
                  status: status
              },
              success: function (response) {
                  toastr.success(response.message);
                  loadTable();
              },
              error: function () {
                toastr.error('Something went wrong. Please try again.');
              }
          });
      }
      $('#classFilter').change(function() {
        loadTable();
      });

    </script>
@endsection
