@extends('layouts.layout')
@section('content')
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color">
      <h4 class="page-title"> Add New Employee </h4>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Employees</a></li>
          <li class="breadcrumb-item active" aria-current="page">New Employee</li>
        </ol>
      </nav>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            {{-- <h4 class="card-title">Employee Details</h4> --}}
            <form id="employee-form"  enctype="multipart/form-data">
              @csrf
              {{-- <p class="card-description"> Personal Details </p> --}}
              <!-- Employee Name and Role -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Name</label>
                    <input type="text" name="employee_name" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employee Role</label>
                    <select name="employee_role" class="form-control form-select form-control-sm" >
                      <option value="">Choose</option>
                      <option value="Role1">Role1</option>
                      <option value="Role2">Role2</option>
                      <option value="Role3">Role3</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- Date of Birth and Gender -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control form-select form-control-sm" id="exampleSelectGender" >
                      <option value="">Choose</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                  </div>
                </div>
              </div>
              <!-- Email and Blood Group -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Blood Group</label>
                    <input type="text" name="blood_grp" class="form-control form-control-sm" maxlength="3" >
                  </div>
                </div>
              </div>
              <!-- Marital Status and Relative Name -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Marital Status</label>
                    <select name="marital_status" class="form-control form-control-sm form-select" >
                      <option value="">Choose</option>
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                      <option value="divorced">Divorced</option>
                      <option value="widowed">Widowed</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Father/Husband Name</label>
                    <input type="text" name="emp_relative_name" class="form-control form-control-sm" >
                  </div>
                </div>
              </div>
              <!-- Religion and Community -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Community</label>
                    <input type="text" name="community" class="form-control form-control-sm" >
                  </div>
                </div>
              </div>
              <!-- Nationality and Education -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Education</label>
                    <input type="text" name="education" class="form-control form-control-sm" >
                  </div>
                </div>
              </div>
              <!-- Experience and Date of Joining -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Experience (Years)</label>
                    <input type="number" name="experience" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date of Joining</label>
                    <input type="date" name="doj" class="form-control form-control-sm" >
                  </div>
                </div>
              </div>
              <!-- Monthly Salary and Aadhar Number -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Monthly Salary</label>
                    <input type="number" step="0.01" name="monthly_salary" class="form-control form-control-sm" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Aadhar Number</label>
                    <input type="text" name="aadharno" class="form-control form-control-sm" maxlength="12" >
                  </div>
                </div>
              </div>
              <!-- Mobile Numbers and WhatsApp Status -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobileno" class="form-control form-control-sm" maxlength="10" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Alternate Mobile Number</label>
                    <input type="text" name="alt_mobileno" class="form-control form-control-sm" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="row  mx-2">
                <div class="col-md-6 m-0">
                  <div class="form-group ">
                    {{-- <label>WhatsApp Status (Mobile)</label>
                    <select name="mobileno_wp_status" class="form-control form-select form-control-sm">
                      <option value="">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select> --}}
                    <div class="form-check ">
                      <input type="checkbox" id="mobileno_wp_status"  name="mobileno_wp_status" value="1" class="form-check-input">
                      <label for="mobileno_wp_status" class="form-check-label">WhatsApp (Mobile)</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-5  mx-4  ">
                  <div class="form-group ">
                    <div class="form-check ">
                      <input type="checkbox" id="alt_mobileno_wp_status"  name="alt_mobileno_wp_status" value="1" class="form-check-input">
                      <label for="alt_mobileno_wp_status" class="form-check-label">WhatsApp (Alternate)</label>
                    </div>
                    {{-- <label>WhatsApp Status (Alternate)</label>
                    <select name="alt_mobileno_wp_status" class="form-control form-select form-control-sm">
                      <option value="">Choose</option>
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                    </select> --}}
                  </div>
                </div>
              </div>
              <!-- Addresses -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Permanent Address</label>
                    <textarea id="permanent_address" name="permanent_address" class="form-control form-control-sm" rows="3" ></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Current Address</label>
                    <textarea id="current_address" name="current_address" class="form-control form-control-sm" rows="3"></textarea>
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
              </div>
              
              <!-- Profile Picture -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control" accept="image/*">
                    {{-- <label>File upload</label>
                        <input type="file" name="profile_picture" class="file-upload-default" accept="image/*">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                          </span>
                        </div> --}}
                  </div>
                  
                </div>
              </div>
              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary mr-2" id="submit-employee">Submit</button>
              <a href="{{ route('employeesMaster.index') }}" class="btn btn-light mr-2">Cancel</a>
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
    $('#employee-form').submit(function (e) {
      $(this).find('.text-danger').remove();
      e.preventDefault();
        const submitButton = $('#submit-employee');
        submitButton.prop('disabled', true);
        submitButton.text('Loading...'); 
        let formData = new FormData(this);

        $.ajax({
          url: '{{route("employeesMaster.store")}}', // Change this to your form submission URL
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
                submitButton.text('Submit');
                console.log(xhr)
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

