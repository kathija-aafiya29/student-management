@extends('layouts.layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header header-card-color">
                <h4 class="page-title">Customize Grading</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Customize Grading</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grading</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Grade List</h4>
                                <button class="btn btn-info btn-sm mb-2" onclick="openModal()">Add Grade</button>
                            </div>
                            <!-- Student Table -->
                            <table id="studentTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Grade</th>
                                        <th>From</th>
                                        <th>Upto</th>
                                        <th>Status</th>
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
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                ajax: "{{ route('customGrading.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'grade', name: 'grade' },
                    { data: 'from', name: 'from' },
                    { data: 'to', name: 'to' },
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        }

        function openModal(id = null) {
          $('#gradingForm')[0].reset();
          $('#gradingId').val('');
        $('.text-danger').remove(); // Remove previous validation errors
          
          if (id) {
              $.ajax({
                  url: "{{ route('customGrading.edit', ':id') }}".replace(':id', id),
                  type: "GET",
                  dataType: "JSON",
                  success: function (data) {
                      $('#gradingId').val(data.id);
                      $('#grade').val(data.grade);
                      $('#from').val(data.from);
                      $('#to').val(data.to);
                      $('#status').val(data.status);
                      $('#gradingModal').modal('show');

                  },
                error: function (xhr) {
                  console.log('Error fetching data.');
                }
              });
          } else {
              $('#gradingModal').modal('show');
          }
      }


      $('#gradingForm').submit(function(e) {
        e.preventDefault();
        $('.text-danger').remove(); // Remove previous validation errors

        const submitButton = $('#update-form');
        submitButton.prop('disabled', true).text('Updating...');
          var id = $('#gradingId').val();
          var url = id ? "{{ route('customGrading.update', ':id') }}".replace(':id', id) : "{{ route('customGrading.store') }}";
          var method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: $(this).serialize(),
                success: function () {
                    $('#gradingModal').modal('hide');
                    $('#studentTable').DataTable().ajax.reload();
                    submitButton.prop('disabled', false).text('Save');
                    toastr.success('Grade Updated successfully!', 'Success');
                },
                error: function (xhr) {
                    submitButton.prop('disabled', false).text('Save');

                    if (xhr.responseJSON) {
                    const errors = xhr.responseJSON.details;
                   
                    Object.keys(errors).forEach(function (key) {
                        const errorMsg = errors[key][0];
                        $(`[name="${key}"]`).after(`<small class="text-danger">${errorMsg}</small>`);
                    });
                    toastr.error('Please fix the errors and try again.', 'Validation Error');
                        } else {
                            const error = xhr.responseJSON?.message || 'An error occurred.';
                            toastr.error(error, 'Error');
                        }
                }
            });
        });

        function deleteGrading(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                width: "350px",  
                heightAuto: false,
                customClass: {
                    popup: "small-swal"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('customGrading') }}/" + id,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function () {
                            Swal.fire("Deleted!", "Grade has been deleted.", "success");
                            $('#studentTable').DataTable().ajax.reload();
                        },
                        error: function () {
                            Swal.fire("Error!", "Something went wrong.", "error");
                        }
                    });
                }
            });
        }

    </script>
@endsection
