@extends('layouts.layout')
@section('content')
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color">
      <h4 class="page-title"> Edit Employee </h4>
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
            <form id="employee-update-form"   method="POST" enctype="multipart/form-data">
               
                @csrf
                @method('PUT')
                {{-- <p class="card-description"> Personal Details </p> --}}
                <!-- Employee Name and Role -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Employee Name</label>
                      <input type="text" name="employee_name" class="form-control form-control-sm" value="{{ old('employee_name', $employee->employee_name) }}">
                      <input type="text" name="user_id" id="user_id" value="{{ $employee->id }}" hidden>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Employee Role</label>
                      <select name="employee_role" class="form-control form-select form-control-sm" >
                        <option value="">Choose</option>
                        <option value="Role1" {{ $employee->employee_role == 'Role1' ? 'selected' : '' }}>Role1</option>
                        <option value="Role2" {{ $employee->employee_role == 'Role2' ? 'selected' : '' }}>Role2</option>
                        <option value="Role3" {{ $employee->employee_role == 'Role3' ? 'selected' : '' }}>Role3</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Date of Birth and Gender -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input type="date" name="dob" class="form-control form-control-sm" value="{{ old('dob', $employee->dob) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Gender</label>
                      <select name="gender" class="form-control form-select form-control-sm" id="exampleSelectGender" >
                        <option value="">Choose</option>
                        <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $employee->gender == 'other' ? 'selected' : '' }}>Other</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Email and Blood Group -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $employee->email) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Blood Group</label>
                      <input type="text" name="blood_grp" class="form-control form-control-sm" maxlength="3" value="{{ old('blood_grp', $employee->blood_grp) }}">
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
                        <option value="single" {{ $employee->marital_status == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="married" {{ $employee->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="divorced" {{ $employee->marital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        <option value="widowed" {{ $employee->marital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Father/Husband Name</label>
                      <input type="text" name="emp_relative_name" class="form-control form-control-sm" value="{{ old('emp_relative_name', $employee->emp_relative_name) }}">
                    </div>
                  </div>
                </div>
                <!-- Religion and Community -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Religion</label>
                      <input type="text" name="religion" class="form-control form-control-sm" value="{{ old('religion', $employee->religion) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Community</label>
                      <input type="text" name="community" class="form-control form-control-sm" value="{{ old('community', $employee->community) }}">
                    </div>
                  </div>
                </div>
                <!-- Nationality and Education -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nationality</label>
                      <input type="text" name="nationality" class="form-control form-control-sm" value="{{ old('nationality', $employee->nationality) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Education</label>
                      <input type="text" name="education" class="form-control form-control-sm" value="{{ old('education', $employee->education) }}">
                    </div>
                  </div>
                </div>
                <!-- Experience and Date of Joining -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Experience (Years)</label>
                      <input type="number" name="experience" class="form-control form-control-sm" value="{{ old('experience', $employee->experience) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date of Joining</label>
                      <input type="date" name="doj" class="form-control form-control-sm" value="{{ old('doj', $employee->doj) }}">
                    </div>
                  </div>
                </div>
                <!-- Monthly Salary and Aadhar Number -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Monthly Salary</label>
                      <input type="number" step="0.01" name="monthly_salary" class="form-control form-control-sm" value="{{ old('monthly_salary', $employee->monthly_salary) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Aadhar Number</label>
                      <input type="text" name="aadharno" class="form-control form-control-sm" maxlength="12" value="{{ old('aadharno', $employee->aadharno) }}">
                    </div>
                  </div>
                </div>
                <!-- Mobile Numbers and WhatsApp Status -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mobile Number</label>
                      <input type="text" name="mobileno" class="form-control form-control-sm" maxlength="10" value="{{ old('mobileno', $employee->mobileno) }}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Alternate Mobile Number</label>
                      <input type="text" name="alt_mobileno" class="form-control form-control-sm" maxlength="10" value="{{ old('alt_mobileno', $employee->alt_mobileno) }}">
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
                        <input type="checkbox" id="mobileno_wp_status"  name="mobileno_wp_status" value="1" class="form-check-input" {{ $employee->mobileno_wp_status == 1 ? 'checked' : '' }}> 
                        <label for="mobileno_wp_status" class="form-check-label">WhatsApp (Mobile)</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5  mx-4  ">
                    <div class="form-group ">
                      <div class="form-check ">
                        <input type="checkbox" id="alt_mobileno_wp_status"  name="alt_mobileno_wp_status" value="1" class="form-check-input" {{ $employee->alt_mobileno_wp_status == 1 ? 'checked' : '' }}>
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
                      <textarea id="permanent_address" name="permanent_address" class="form-control form-control-sm" rows="3" > {{ old('permanent_address', $employee->permanent_address) }}</textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Current Address</label>
                      <textarea id="current_address" name="current_address" class="form-control form-control-sm" rows="3"> {{ old('current_address', $employee->current_address) }}</textarea>
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
                      @if($employee->profile_picture)
                          <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="Profile Picture" class="img-fluid mt-2" width="100">
                      @endif
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
                <button type="submit" class="btn btn-primary mr-2" id="update-employee">Update</button>
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
    $('#employee-update-form').on('submit', function (e) {
    e.preventDefault();
    $('.text-danger').remove(); // Remove previous validation errors

    const submitButton = $('#update-employee');
    submitButton.prop('disabled', true).text('Updating...');

    // let formData = new FormData(this);
    // for (let [key, value] of formData.entries()) {
    //     console.log(key, value); // Log each key-value pair in the FormData object
    // }

    let employeeId = $('#user_id').val(); // Assuming an input field with the employee ID
    let updateUrl = '{{ url("employeesMaster") }}/' + employeeId;
    // console.log("formdata",formData);
    var formData = new FormData($('#employee-update-form')[0]);
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

            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors || {};
                $.each(errors, function (key, messages) {
                    $(`[name="${key}"]`).after(`<small class="text-danger">${messages[0]}</small>`);
                });
                toastr.error('Please fix the errors and try again.', 'Validation Error');
            } else {
                let errorMessage = xhr.responseJSON?.message || 'An error occurred.';
                toastr.error(errorMessage, 'Error');
            }
        }
    });
});

});


</script>
@endsection

