@extends('layouts.layout')
@section('content')
<div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Fee Structure </h3>
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
                    {{-- <h4 class="card-title">Horizontal Two column</h4> --}}
                    <form class="form-sample">
                      {{-- <p class="card-description"> Personal info </p> --}}
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Class</label>
                            <select name="class_type" class="form-control form-select form-control-sm" >
                              <option value="">Choose</option>
                              <option value="Class1">Class1</option>
                              <option value="Class2">Class2</option>
                              <option value="Class3">Class3</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>FeeType</label>
                            <select name="fee_type" class="form-control form-select form-control-sm" >
                              <option value="">Choose</option>
                              <option value="Fee1">Fee1</option>
                              <option value="Fee2">Fee2</option>
                              <option value="Fee3">Fee3</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Caste</label>
                            <select name="caste_role" class="form-control form-select form-control-sm" >
                              <option value="">Choose</option>
                              <option value="Caste1">Caste1</option>
                              <option value="Caste2">Caste2</option>
                              <option value="Caste3">Caste3</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Monthly Tution Fee</label>
                            <div class="col-sm-7">
                              <input type="text" name="m_tution_fee" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Administration Fee</label>
                            <div class="col-sm-7">
                              <input type="text" name="admin_fee" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Registration Fee</label>
                            <div class="col-sm-7">
                              <input type="text" name="registration_fee" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div> 
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Art Material</label>
                            <div class="col-sm-7">
                              <input type="text" name="art_material" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Books</label>
                            <div class="col-sm-7">
                              <input type="text" name="books" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Uniform</label>
                            <div class="col-sm-7">
                              <input type="text" name="m_tution_fee" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Others</label>
                            <div class="col-sm-7">
                              <input type="text" name="others" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-2">
                          <div class="form-group row">
                            <label class="col-sm-4  col-form-label">Total Amount</label>
                            <div class="col-sm-7">
                              <input type="text" name="total_amount" class="form-control form-control-sm">

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 offset-sm-3">
                          <div class=" row">
                            <button type="submit" class="btn btn-primary mr-2 col-sm-3" id="submit-employee">Submit</button>
                            <a href="{{ route('employeesMaster.index') }}" class="btn btn-light mr-2 col-sm-3">Cancel</a>
                          </div></div>
                      
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          @include('layouts.footer')
          <!-- partial -->
        </div>
@endsection
