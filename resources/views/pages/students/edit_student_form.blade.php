@extends('layouts.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header header-card-color">
            <h4 class="page-title"> Edit Student </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Students</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Student</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                       {{-- <h4 class="card-title">Student Details</h4> --}}

                       <form id="student-update-form" method="POST" enctype="multipart/form-data">
               
                        @csrf
                        @method('PUT')
                            
                            <!-- Student Details -->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_name">Student Name</label>
                                    <input type="text" class="form-control form-control-sm" id="student_name" name="student_name" value="{{ old('student_name', $student->student_name) }}">
                                    <input type="text" class="form-control form-control-sm" id="user_id" name="user_id" value="{{ old('user_id', $student->id) }}" hidden>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  
                                  <label for="class">Class</label>
                                  <select class="form-control form-control-sm form-select" id="class" name="class">
                                    <option value="">Select Class</option>
                                      @foreach($classes as $class)
                                      <option value="{{ $class->id }}" {{$student->class == $class->id ? "selected":""}}>{{ $class->class_name }}</option>
                                      @endforeach
                                    </select>
                                 </div>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="dob">Date of Birth</label>
                                  <input type="date" class="form-control form-control-sm" id="dob" name="dob"  value="{{ old('dob', $student->dob) }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="gender">Gender</label>
                                  <select class="form-control form-control-sm form-select" id="gender" name="gender" >
                                        <option value="">Select</option>
                                      <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                      <option value="Female" {{ $student->gender== 'Female' ? 'selected' : '' }}>Female</option>
                                      <option value="Other" {{ $student->gender== 'Other' ? 'selected' : '' }}>Other</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="religion">Religion</label>
                                  <input type="text" class="form-control form-control-sm" id="religion" name="religion" value="{{ old('religion', $student->religion) }}">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="community">Community</label>
                                  <input type="text" class="form-control form-control-sm" id="community" name="community" value="{{ old('community', $student->community) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control form-control-sm" id="nationality" name="nationality" value="Indian" value="{{ old('nationality', $student->nationality) }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="orphan_student_status">Orphan Status</label>
                                  <select class="form-control form-control-sm form-select" id="orphan_student_status" name="orphan_student_status" >
                                   
                                      <option value="0" {{ $student->orphan_student_status== '0' ? 'selected' : '' }}>NO</option>
                                      <option value="1" {{ $student->orphan_student_status== '1' ? 'selected' : '' }}>YES</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="birth_id">Birth ID</label>
                                  <input type="text" class="form-control form-control-sm" id="birth_id" name="birth_id" value="{{ old('birth_id', $student->birth_id) }}">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="aadharno">Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="aadharno" name="aadharno" maxlength="12" value="{{ old('aadharno', $student->aadharno) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="identification_mark">Identification Mark</label>
                                  <input type="text" class="form-control form-control-sm" id="identification_mark" name="identification_mark"  value="{{ old('identification_mark', $student->identification_mark) }}">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="previous_school">Previous School</label>
                                  <input type="text" class="form-control form-control-sm" id="previous_school" name="previous_school" value="{{ old('previous_school', $student->previous_school) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="total_siblings">Total Siblings</label>
                                  <input type="number" class="form-control form-control-sm" id="total_siblings" name="total_siblings" value="{{ old('total_siblings',$student->total_siblings)}}" >
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="blood_grp">Blood Group</label>
                                  <input type="text" class="form-control form-control-sm" id="blood_grp" name="blood_grp" value="{{ old('blood_grp', $student->blood_grp) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="disease_status">Disease Status</label>
                                  <select class="form-control form-control-sm form-select" id="disease_status" name="disease_status">
                                    <option value="0" {{ $student->disease_status== '0' ? 'selected' : '' }}>NO</option>
                                    <option value="1" {{ $student->disease_status== '1' ? 'selected' : '' }}>YES</option>
                                  </select>
                                </div>   
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="doa">Date of Admission</label>
                                  <input type="date" class="form-control form-control-sm" id="doa" name="doa" value="{{ old('doa', $student->doa) }}">
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="discount_fee">Discounted Fee</label>
                                  <input type="number" class="form-control form-control-sm" id="discount_fee" name="discount_fee" step="0.01" value="{{ old('discount_fee', $student->discount_fee) }}">
                                </div>  
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label>Profile Picture</label>
                                    <input type="file" name="profile_picture" class="form-control" accept="image/*">
                                    @if($student->profile_picture)
                                        <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="Profile Picture" class="img-fluid mt-2" width="100">
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="permanent_address">Permanent Address</label>
                                  <textarea class="form-control form-control-sm" id="permanent_address" name="permanent_address" rows="3" > {{ old('permanent_address', $student->permanent_address) }}</textarea>
                                </div> 
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="current_address">Current Address</label>
                                  <textarea class="form-control form-control-sm" id="current_address" name="current_address" rows="3">{{ old('permanent_address', $student->permanent_address) }}</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="row mx-2 mt-0">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <div class="form-check">
                                      <input type="checkbox" id="same_as_permanent" class="form-check-input">
                                      <label for="same_as_permanent" class="form-check-label">Same as Permanent Address</label>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $student->email) }}">
                                </div>
                              </div>
                            </div>
                            <h5>Father's Details</h5>

                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="father_name">Father's Name</label>
                                    <input type="text" class="form-control form-control-sm" id="father_name" name="father_name" value="{{ old('father_name', $student->father_name) }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_aadhaar_no">Father's Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="father_aadhaar_no" name="father_aadhaar_no" maxlength="12" value="{{ old('father_aadhaar_no', $student->father_aadhaar_no) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_occupation">Father's Occupation</label>
                                  <input type="text" class="form-control form-control-sm" id="father_occupation" name="father_occupation" value="{{ old('father_occupation', $student->father_occupation) }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_mobile_no">Father's Mobile Number</label>
                                  <input type="text" class="form-control form-control-sm" id="father_mobile_no" name="father_mobile_no" value="{{ old('father_mobile_no', $student->father_mobile_no) }}">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_mobile_status_wp">WhatsApp Status</label>
                                  <select class="form-control form-control-sm form-select" id="father_mobile_status_wp" name="father_mobile_status_wp">
                                    <option value="0" {{ $student->father_mobile_status_wp== '0' ? 'selected' : '' }}>NO</option>
                                    <option value="1" {{ $student->father_mobile_status_wp== '1' ? 'selected' : '' }}>YES</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_income">Father's Income</label>
                                  <input type="number" class="form-control form-control-sm" id="father_income" name="father_income" step="0.01" value="{{ old('father_income', $student->father_income) }}">
                                </div>
                              </div>
                            </div>
                            <!-- Mother Details -->
                            <h5>Mother's Details</h5>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_name">Mother's Name</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_aadhaar_no">Mother's Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_aadhaar_no" name="mother_aadhaar_no" maxlength="12" value="{{ old('mother_aadhaar_no', $student->mother_aadhaar_no) }}">
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_occupation">Mother's Occupation</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation', $student->mother_occupation) }}">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_mobile_no">Mother's Mobile Number</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_mobile_no" name="mother_mobile_no" value="{{ old('mother_mobile_no', $student->mother_mobile_no) }}">
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_mobile_status_wp">WhatsApp Status</label>
                                  <select class="form-control form-control-sm form-select" id="mother_mobile_status_wp" name="mother_mobile_status_wp">
                                    <option value="0" {{ $student->mother_mobile_status_wp== '0' ? 'selected' : '' }}>NO</option>
                                    <option value="1" {{ $student->mother_mobile_status_wp== '1' ? 'selected' : '' }}>YES</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_income">Mother's Income</label>
                                  <input type="number" class="form-control form-control-sm" id="mother_income" name="mother_income" step="0.01" value="{{ old('mother_income', $student->mother_income) }}">
                                </div>
                              </div>
                            </div>
                            

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mr-2 update-student">Update</button>
                            <a href="{{ route('studentsMaster.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function () {
    // Handle checkbox change
    $('#same_as_permanent').change(function () {
      if ($(this).is(':checked')) {
        $('#current_address').val($('#permanent_address').val()).prop('readonly', true);
      } else {
        // Allow editing Current Address
        $('#current_address').val('').prop('readonly', false);
      }
    });

    $('#permanent_address').on('input', function () {
      if ($('#same_as_permanent').is(':checked')) {
        $('#current_address').val($(this).val());
      }
    });
    $('#student-update-form').on('submit', function (e) {
        e.preventDefault();
        $('.text-danger').remove(); // Remove previous validation errors

        const submitButton = $('#update-student');
        submitButton.prop('disabled', true).text('Updating...');

        // let formData = new FormData(this);
        // for (let [key, value] of formData.entries()) {
        //     console.log(key, value); // Log each key-value pair in the FormData object
        // }

        let studentID = $('#user_id').val(); // Assuming an input field with the employee ID
        let updateUrl = '{{ url("studentsMaster") }}/' + studentID;
        // console.log("formdata",formData);
        var formData = new FormData($('#student-update-form')[0]);
        formData.append('_method', 'PUT');

        $.ajax({
            url: updateUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    submitButton.prop('disabled', false).text('Update');
                        toastr.success(response.message, 'Success');   
                
                    
                },
                error: function (xhr) {
                    submitButton.prop('disabled', false).text('Update');

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
  });
</script>
@endsection
