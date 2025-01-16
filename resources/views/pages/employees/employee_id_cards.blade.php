<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Employee ID Card</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layouts.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            @include('layouts.sideBar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Employee ID Card</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Employees</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Employee ID Card</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee List</h4>
                                    <!-- Employee Table -->
                                    <table id="employeeTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John</td>
                                                <td>Doe</td>
                                                <td>Software Engineer</td>
                                                <td><button class="btn btn-info view-id-card" data-id="1">View ID
                                                        Card</button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane</td>
                                                <td>Smith</td>
                                                <td>Data Analyst</td>
                                                <td><button class="btn btn-info view-id-card" data-id="2">View ID
                                                        Card</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for Employee ID Card -->

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                @include('layouts.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
        <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Employee ID Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="id_card_content">
                        <!-- Employee ID Card Content -->
                        <p><strong>First Name: </strong><span id="empFirstName"></span></p>
                        <p><strong>Last Name: </strong><span id="empLastName"></span></p>
                        <p><strong>Role: </strong><span id="empRole"></span></p>
                        <p><strong>Date of Birth: </strong><span id="empDOB"></span></p>
                        <p><strong>Category: </strong><span id="empCategory"></span></p>
                        <p><strong>Membership: </strong><span id="empMembership"></span></p>
                        <p><strong>Address: </strong><span id="empAddress"></span></p>
                        <p><strong>State: </strong><span id="empState"></span></p>
                        <p><strong>Postcode: </strong><span id="empPostcode"></span></p>
                        <p><strong>City: </strong><span id="empCity"></span></p>
                        <p><strong>Country: </strong><span id="empCountry"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="download-pdf">Download ID
                            Card</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <!-- endinject -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#employeeTable').DataTable(
            //     {
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('datatable.employees.idcards') }}",
            //     columns: [{
            //             data: 'id',
            //             name: 'id'
            //         },
            //         {
            //             data: 'name',
            //             name: 'name'
            //         },
            //         {
            //             data: 'class',
            //             name: 'class'
            //         },
            //         {
            //             data: 'roll_number',
            //             name: 'roll_number'
            //         },
            //         {
            //             data: 'created_at',
            //             name: 'created_at'
            //         },
            //         {
            //             data: 'actions',
            //             name: 'actions',
            //             orderable: false,
            //             searchable: false
            //         },
            //     ]
            // }
        );

            // View Employee ID Card button click
            $('.view-id-card').on('click', function() {
                const employeeId = $(this).data('id');
                // Fetch employee details (for simplicity, using static data here)
                if (employeeId === 1) {
                    $('#empFirstName').text('John');
                    $('#empLastName').text('Doe');
                    $('#empRole').text('Software Engineer');
                    $('#empDOB').text('1990-05-15');
                    $('#empCategory').text('Category1');
                    $('#empMembership').text('Free');
                    $('#empAddress').text('123 Main St');
                    $('#empState').text('New York');
                    $('#empPostcode').text('10001');
                    $('#empCity').text('New York');
                    $('#empCountry').text('USA');
                } else if (employeeId === 2) {
                    $('#empFirstName').text('Jane');
                    $('#empLastName').text('Smith');
                    $('#empRole').text('Data Analyst');
                    $('#empDOB').text('1992-08-22');
                    $('#empCategory').text('Category2');
                    $('#empMembership').text('Professional');
                    $('#empAddress').text('456 Market St');
                    $('#empState').text('California');
                    $('#empPostcode').text('94105');
                    $('#empCity').text('San Francisco');
                    $('#empCountry').text('USA');
                }

                // Show modal
                $('#idCardModal').modal('show');
            });

            // Download ID Card PDF
            $('#download-pdf').on('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                const idCardContent = document.getElementById('id_card_content');

                html2canvas(idCardContent, {
                    useCORS: true,
                    scrollX: 0,
                    scrollY: -window.scrollY,
                    windowWidth: document.body.scrollWidth,
                    windowHeight: document.body.scrollHeight,
                    onrendered: function(canvas) {
                        const imgData = canvas.toDataURL('image/png');
                        const imgWidth = doc.internal.pageSize.getWidth();
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;

                        // Add the image to the PDF
                        doc.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                        // Save the PDF
                        doc.save('Employee_ID_Card.pdf');
                    }
                });
            });
        });
    </script>
</body>

</html>
