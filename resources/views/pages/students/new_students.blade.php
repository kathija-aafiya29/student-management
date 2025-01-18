@extends('layouts.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header header-card-color">
            <h4 class="page-title"> New Student </h4>
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

                      <form id="student-form"  enctype="multipart/form-data">
                        @csrf
                            
                            <!-- Student Details -->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label for="student_name">Student Name</label>
                                    <input type="text" class="form-control form-control-sm" id="student_name" name="student_name" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  
                                  <label for="class">Class</label>
                                  <select class="form-control form-control-sm form-select" id="class" name="class">
                                    <option value="Class 1">Class 1</option>
                                    <option value="Class 2">Class 2</option>
                                    <option value="Class 3">Class 3</option>
                                    </select>
                                 </div>
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="dob">Date of Birth</label>
                                  <input type="date" class="form-control form-control-sm" id="dob" name="dob" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="gender">Gender</label>
                                  <select class="form-control form-control-sm form-select" id="gender" name="gender" >
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                      <option value="Other">Other</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="religion">Religion</label>
                                  <input type="text" class="form-control form-control-sm" id="religion" name="religion">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="community">Community</label>
                                  <input type="text" class="form-control form-control-sm" id="community" name="community">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="nationality">Nationality</label>
                                  <input type="text" class="form-control form-control-sm" id="nationality" name="nationality" value="Indian">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="orphan_student_status">Orphan Status</label>
                                  <select class="form-control form-control-sm form-select" id="orphan_student_status" name="orphan_student_status">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="birth_id">Birth ID</label>
                                  <input type="text" class="form-control form-control-sm" id="birth_id" name="birth_id">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="aadharno">Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="aadharno" name="aadharno" maxlength="12">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="identification_mark">Identification Mark</label>
                                  <input type="text" class="form-control form-control-sm" id="identification_mark" name="identification_mark">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="previous_school">Previous School</label>
                                  <input type="text" class="form-control form-control-sm" id="previous_school" name="previous_school">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="total_siblings">Total Siblings</label>
                                  <input type="number" class="form-control form-control-sm" id="total_siblings" name="total_siblings" value="0">
                              </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="blood_grp">Blood Group</label>
                                  <input type="text" class="form-control form-control-sm" id="blood_grp" name="blood_grp">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="disease_status">Disease Status</label>
                                  <select class="form-control form-control-sm form-select" id="disease_status" name="disease_status">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                  </select>
                                </div>   
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="doa">Date of Admission</label>
                                  <input type="date" class="form-control form-control-sm" id="doa" name="doa" >
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="discount_fee">Discounted Fee</label>
                                  <input type="number" class="form-control form-control-sm" id="discount_fee" name="discount_fee" step="0.01">
                                </div>  
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="profile_picture">Profile Picture</label>
                                  <input type="file" class="form-control " id="profile_picture" name="profile_picture">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                
                                <div class="form-group">
                                  <label for="permanent_address">Permanent Address</label>
                                  <textarea class="form-control form-control-sm" id="permanent_address" name="permanent_address" rows="3" ></textarea>
                                </div> 
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="current_address">Current Address</label>
                                  <textarea class="form-control form-control-sm" id="current_address" name="current_address" rows="3"></textarea>
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
                                  <input type="email" name="email" class="form-control form-control-sm" >
                                </div>
                              </div>
                            </div>
                            <h5>Father's Details</h5>

                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="father_name">Father's Name</label>
                                    <input type="text" class="form-control form-control-sm" id="father_name" name="father_name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_aadhaar_no">Father's Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="father_aadhaar_no" name="father_aadhaar_no" maxlength="12">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_occupation">Father's Occupation</label>
                                  <input type="text" class="form-control form-control-sm" id="father_occupation" name="father_occupation">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_mobile_no">Father's Mobile Number</label>
                                  <input type="text" class="form-control form-control-sm" id="father_mobile_no" name="father_mobile_no">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_mobile_status_wp">WhatsApp Status</label>
                                  <select class="form-control form-control-sm form-select" id="father_mobile_status_wp" name="father_mobile_status_wp">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="father_income">Father's Income</label>
                                  <input type="number" class="form-control form-control-sm" id="father_income" name="father_income" step="0.01">
                                </div>
                              </div>
                            </div>
                            <!-- Mother Details -->
                            <h5>Mother's Details</h5>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_name">Mother's Name</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_aadhaar_no">Mother's Aadhaar Number</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_aadhaar_no" name="mother_aadhaar_no" maxlength="12">
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_occupation">Mother's Occupation</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_occupation" name="mother_occupation">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_mobile_no">Mother's Mobile Number</label>
                                  <input type="text" class="form-control form-control-sm" id="mother_mobile_no" name="mother_mobile_no">
                                 </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_mobile_status_wp">WhatsApp Status</label>
                                  <select class="form-control form-control-sm form-select" id="mother_mobile_status_wp" name="mother_mobile_status_wp">
                                      <option value="0">No</option>
                                      <option value="1">Yes</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="mother_income">Mother's Income</label>
                                  <input type="number" class="form-control form-control-sm" id="mother_income" name="mother_income" step="0.01">
                                </div>
                              </div>
                            </div>
                            

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
    $('#student-form').submit(function (e) {
      $(this).find('.text-danger').remove();
      e.preventDefault();
        const submitButton = $('#submit-employee');
        submitButton.prop('disabled', true);
        submitButton.text('Loading...'); 
        let formData = new FormData(this);

        $.ajax({
          url: '{{route("studentsMaster.store")}}', // Change this to your form submission URL
          method: 'POST',
          data: formData,
            processData: false, // Important for file upload
            contentType: false, // Important for file upload
          success: function (response) {
            submitButton.prop('disabled', false);
            submitButton.text('Submit');
            $("#employee-form")[0].reset();
            toastr.success(response.message, 'Success');
          },
          error: function (xhr) {
            submitButton.prop('disabled', false);
                submitButton.text('Add');
                if (xhr.responseJSON) {
                  const errors = xhr.responseJSON.details;
                    Object.keys(errors).forEach(function (key) {
                        const errorMsg = errors[key][0];
                        $(`[name="${key}"]`).after(`<small class="text-danger">${errorMsg}</small>`);
                    });
                } else {
                    const error = xhr.responseJSON?.message || 'An error occurred.';
                    $('.errorModalMsg').text(error);
                    $('.errorModalPm').modal('show');
                    setTimeout(function () {
                        $('.errorModalPm').modal('hide');
                    }, 3000);
                }
            toastr.error('An error occurred. Please try again.', 'Error');
          }
        });
      });
  });
</script>
@endsection
