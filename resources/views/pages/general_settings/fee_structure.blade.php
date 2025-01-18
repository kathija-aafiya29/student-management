@extends('layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header header-card-color">
            <h4 class="page-title"> Fee Structure </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">General Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fee Structure</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-sample" id="fee-structure-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Class</label>
                                        <select name="class_id" class="form-control form-select form-control-sm">
                                            <option value="">Choose</option>
                                            @foreach($classes as $class)
                                            <option value="{{$class->id}}">{{$class->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Fee Type</label>
                                        <select name="fee_type" class="form-control form-select form-control-sm">
                                            <option value="">Choose</option>
                                            <option value="Annual">Annual</option>
                                            <option value="Term 1">Term 1</option>
                                            <option value="Term 2">Term 2</option>
                                            <option value="Term 3">Term 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Caste</label>
                                        <select name="caste_id" class="form-control form-select form-control-sm">
                                            <option value="">Choose</option>
                                            @foreach($castes as $caste)
                                            <option value="{{$caste->id}}">{{$caste->caste_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label >Monthly Tuition Fee</label>
                                        <input type="number" name="monthly_tution_fee" class="form-control form-control-sm fee-input">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label >Admission Fee</label>
                                        <input type="number" name="admission_fee" class="form-control form-control-sm fee-input">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label >Registration Fee</label>
                                        <input type="number" name="registration_fee" class="form-control form-control-sm fee-input">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Art Material</label>
                                    <input type="number" name="art_material" class="form-control form-control-sm fee-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Transport</label>
                                      <input type="number" name="transport" class="form-control form-control-sm fee-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Books</label>
                                      <input type="number" name="books" class="form-control form-control-sm fee-input">
                                </div>
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Uniform</label>
                                      <input type="number" name="uniform" class="form-control form-control-sm fee-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Others</label>
                                      <input type="number" name="others" class="form-control form-control-sm fee-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label >Total Amount</label>
                                      <input type="text" name="total_amount" class="form-control form-control-sm" id="total_amount" readonly>
                                </div>
                            </div>
                          </div>

                            <div class="row">
                                <div class="col-md-6 offset-sm-3">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <button type="submit" class="btn btn-primary mr-2 col-sm-3" id="submit-employee">Submit</button>
                                        <a href="{{ route('employeesMaster.index') }}" class="btn btn-light mr-2 col-sm-3">Cancel</a>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Calculate total amount whenever any fee input changes
        $('.fee-input').on('input', function () {
            let totalAmount = 0;
            $('.fee-input').each(function () {
                totalAmount += parseFloat($(this).val()) || 0;
            });
            $('#total_amount').val(totalAmount);
        });
        $('#fee-structure-form').submit(function (e) {
          $(this).find('.text-danger').remove();
          e.preventDefault();
            const submitButton = $('#submit-employee');
            submitButton.prop('disabled', true);
            submitButton.text('Loading...'); 
            let formData = new FormData(this);

            $.ajax({
              url: '{{route("feeStructure.store")}}', // Change this to your form submission URL
              method: 'POST',
              data: formData,
                processData: false, // Important for file upload
                contentType: false, // Important for file upload
              success: function (response) {
                submitButton.prop('disabled', false);
                submitButton.text('Submit');
                $("#fee-structure-form")[0].reset();
                toastr.success(response.message, 'Success');
              },
              error: function (xhr) {
                submitButton.prop('disabled', false);
                    submitButton.text('Add');
                    console.log(xhr)
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
