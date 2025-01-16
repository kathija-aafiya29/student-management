@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> View structure </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">General Settings</a></li>
          <li class="breadcrumb-item active" aria-current="page">View structure</li>
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
           
            </form>
            <div class="col-lg-12 grid-margin stretch-card">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> Fee Structure/Caste </th>
                      <th> Caste 1 </th>
                      <th> Caste 2</th>
                      <th> Caste 3</th>
                      <th> Caste 4 </th>
                      <th> Caste 5 </th>
                      <th> Caste 6 </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> Monthly Tution Fee </td>
                      <td> Herman Beck </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 77.99 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Admission Fee </td>
                      <td> Messsy Adam </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $245.30 </td>
                      <td> July 1, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Registration Fee </td>
                      <td> John Richards </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $138.00 </td>
                      <td> Apr 12, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Transport </td>
                      <td> Peter Meggik </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 77.99 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Books </td>
                      <td> Edward </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-danger" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 160.25 </td>
                      <td> May 03, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Uniform </td>
                      <td> John Doe </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 123.21 </td>
                      <td> April 05, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Others </td>
                      <td> Henry Tom </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 150.00 </td>
                      <td> June 16, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                    <tr>
                      <td> Total Amount </td>
                      <td> Henry Tom </td>
                      <td>
                        <div class="progress">
                          <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td>
                      <td> $ 150.00 </td>
                      <td> June 16, 2015 </td>
                      <td> May 15, 2015 </td>
                      <td> May 15, 2015 </td>
                    </tr>
                  </tbody>
                </table>
            </div>
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
<!-- main-panel ends -->
@endsection
