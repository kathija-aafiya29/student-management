@extends('layouts.layout')

@section('content')
{{-- <style>
  .table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling */
    white-space: nowrap; /* Prevents wrapping of table rows */
}

.table-responsive table {
    min-width: 100%; /* Ensures table takes up full width */
}
  </style> --}}
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header header-card-color">
      <h4 class="page-title"> View structure </h4>
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
                    <label><b>Class</b></label>
                    <select name="class_id" id="class_id" class="form-control form-select form-control-sm">
                      <option value="">Choose</option>
                      @foreach($classes as $class)
                      <option value="{{$class->id}}">{{$class->class_name}}</option>
                      @endforeach
                  </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label><b>Fee Type</b></label>
                    <select name="fee_type" id="fee_type" class="form-control form-select form-control-sm">
                        <option value="">Choose</option>
                        <option value="Annual">Annual</option>
                        <option value="Term 1">Term 1</option>
                        <option value="Term 2">Term 2</option>
                        <option value="Term 3">Term 3</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 p-0">
                  <button type="button" class="btn btn-danger btn-sm" id="clear-btn" style="margin-top: 25px;">Clear</button>
                </div>
                
              </div>
           
            </form>
            <div class="col-lg-12 grid-margin table-responsive stretch-card" >
                <table class="table table-bordered" id="feeStructureTable" style="overflow-x: auto;">
                  <thead>
                    <tr>
                      <th> Fee Structure/Caste </th>
                      @foreach($castes as $caste)
                      <th> {{$caste->caste_name}} </th>
                      @endforeach
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> Monthly Tution Fee </td>
                      {{-- <td>
                        <div class="progress">
                          <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </td> --}}
                      @foreach($castes as $caste)
                      <td> -</td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Admission Fee </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Registration Fee </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Transport </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Books </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Uniform </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Others </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td> Total Amount </td>
                      @foreach($castes as $caste)
                      <td> - </td>
                      @endforeach
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
@section('js')
<script>
    function filterFeeStructure() {
    const classValue = $('#class_id').val();
    const feeTypeValue = $('#fee_type').val();

    $.ajax({
        url: '{{Route("feeStructure.index")}}',
        type: 'GET',
        data: {
            class: classValue,
            fee_type: feeTypeValue
        },
        success: function(data) {
            const tableBody = $('#feeStructureTable tbody');
            tableBody.empty(); // Clear existing table rows

            const feeTypes = [
                "Monthly Tuition Fee",
                "Admission Fee",
                "Registration Fee",
                "Transport",
                "Books",
                "Uniform",
                "Others",
                "Total Amount"
            ];

         feeTypes.forEach(feeType => {
                let row = `<tr><td>${feeType}</td>`;
                
                // Populate columns based on caste
                @json($castes).forEach(caste => {
                    const casteData = data.find(item => item.caste == caste.id);
                    row += `<td>${casteData && casteData[feeType] ? '₹ '+casteData[feeType] : '-'}</td>`;
                });

                row += `</tr>`;
                tableBody.append(row);
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}
$(document).ready(function() {
  filterFeeStructure();
   $('#class_id, #fee_type').change(filterFeeStructure);
   $('#clear-btn').click(function() {
       $('#class_id, #fee_type').val('');
       filterFeeStructure();
   });
});


</script>
@endsection
