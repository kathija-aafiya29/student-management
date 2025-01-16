<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job Offer Letter</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Include Bootstrap for styling and DataTable -->
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
                        <h3 class="page-title"> Job Offer Letter </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Employees</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Job Offer Letter</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Employee Table</h4>
                                    <table class="table table-hover" id="employeeTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Job Title</th>
                                                <th>Start Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>John Doe</td>
                                                <td>Software Engineer</td>
                                                <td>2025-02-01</td>
                                                <td><button class="btn btn-info viewOffer" data-id="1">View Offer
                                                        Letter</button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Jane Smith</td>
                                                <td>Data Analyst</td>
                                                <td>2025-03-01</td>
                                                <td><button class="btn btn-info viewOffer" data-id="2">View Offer
                                                        Letter</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        </div>
        <!-- page-body-wrapper ends -->

        <!-- Modal for viewing Job Offer Letter -->
        <div class="modal fade" id="offerLetterModal" tabindex="-1" aria-labelledby="offerLetterModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="offerLetterModalLabel">Job Offer Letter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="offer_letter" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px;">
                            <h2 style="text-align: center;">Job Offer Letter</h2>
                            <p>Dear <span id="staffName">[Staff Name]</span>,</p>
                            <p>We are pleased to offer you the position of <strong><span
                                        id="staffRole">[Role]</span></strong> at
                                <strong><span id="schoolName">[School Name]</span></strong>.
                            </p>
                            <p>Your start date will be <strong><span id="startDate">[Start Date]</span></strong>, and
                                you will be
                                reporting to <strong><span id="principalName">[Principal Name]</span></strong> at our
                                <strong><span id="location">[Location]</span></strong> school.
                            </p>
                            <p>
                                The starting salary for this position is <strong><span
                                        id="salary">[Salary]</span></strong> per
                                annum, with the additional benefits of
                                <strong><span id="benefits">[Benefits]</span></strong>. Please review the terms and
                                conditions attached in the detailed offer.
                            </p>
                            <p>We are excited to have you join our teaching staff and look forward to your contributions
                                to the
                                students and the school community.</p>
                            <p>Sincerely,</p>
                            <p><strong><span id="yourName">[Your Name]</span></strong></p>
                            <p><strong><span id="yourJobTitle">[Your Job Title]</span></strong></p>
                            <p><strong><span id="schoolNameFooter">[School Name]</span></strong></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="download-pdf" class="btn btn-primary">Download PDF</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
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
            //     ajax: "{{ route('datatable.employees.joboffers') }}",
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

            // View Offer Letter button click
            $('.viewOffer').on('click', function() {
                const employeeId = $(this).data('id');

                // Fetch employee details (here, using static data for simplicity)
                if (employeeId === 1) {
                    $('#staffName').text('John Doe');
                    $('#staffRole').text('Software Engineer');
                    $('#schoolName').text('Tech Corp');
                    $('#startDate').text('2025-02-01');
                    $('#principalName').text('Alice Johnson');
                    $('#location').text('New York');
                    $('#salary').text('$80,000');
                    $('#benefits').text('Health Insurance, 401k');
                    $('#yourName').text('Bob Smith');
                    $('#yourJobTitle').text('HR Manager');
                    $('#schoolNameFooter').text('Tech Corp');
                } else if (employeeId === 2) {
                    $('#staffName').text('Jane Smith');
                    $('#staffRole').text('Data Analyst');
                    $('#schoolName').text('Data Inc');
                    $('#startDate').text('2025-03-01');
                    $('#principalName').text('Tom Green');
                    $('#location').text('San Francisco');
                    $('#salary').text('$70,000');
                    $('#benefits').text('Health Insurance, Paid Time Off');
                    $('#yourName').text('Sarah Lee');
                    $('#yourJobTitle').text('HR Director');
                    $('#schoolNameFooter').text('Data Inc');
                }

                // Show modal
                $('#offerLetterModal').modal('show');
            });

            // Download PDF button click
            $('#download-pdf').on('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Get the content of the offer letter
                const offerLetter = document.getElementById('offer_letter');

                // Use html2canvas with the callback approach
                html2canvas(offerLetter, {
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
                        doc.save('Job_Offer_Letter.pdf');
                    }
                });
            });
        });
    </script>
</body>

</html>
