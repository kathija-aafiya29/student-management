@extends('layouts.layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
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
                                        <th>Job Title</th>0
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Start Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="offerLetterModal" tabindex="-1" aria-labelledby="offerLetterModalLabel" aria-hidden="true">
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
                        <p>We are pleased to offer you the position of <strong><span id="staffRole">[Role]</span></strong>
                            at
                            <strong><span id="schoolName">[School Name]</span></strong>.
                        </p>
                        <p>Your start date will be <strong><span id="startDate">[Start Date]</span></strong>, and
                            you will be
                            reporting to <strong><span id="principalName">[Principal Name]</span></strong> at our
                            <strong><span id="location">[Location]</span></strong> school.
                        </p>
                        <p>
                            The starting salary for this position is <strong><span id="salary">[Salary]</span></strong>
                            per
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
@endsection
@section('js')
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.employees.joboffers') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
                    },
                    {
                        data: 'employee_role',
                        name: 'employee_role'
                    },
                    {
                        data: 'mobileno',
                        name: 'mobileno'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'doj',
                        name: 'doj'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // View Offer Letter button click
            $('.viewOffer').on('click', function() {
                alert('hello')
                const employeeId = $(this).data('id');
                const url = "{{ route('employees.show', ':id') }}".replace(':id', employeeId);
                // Make an AJAX request to fetch employee details from the server
                $.ajax({
                    url: url, // API endpoint to get employee details
                    method: 'GET', // HTTP method
                    success: function(response) {
                        // Check if the response contains valid data
                        if (response && response.data) {
                            const employee = response.data;
                            $('#staffName').text(employee.name);
                            $('#staffRole').text(employee.role);
                            $('#schoolName').text(employee.school);
                            $('#startDate').text(employee.start_date);
                            $('#principalName').text(employee.principal_name);
                            $('#location').text(employee.location);
                            $('#salary').text(employee.salary);
                            $('#benefits').text(employee.benefits);
                            $('#yourName').text(employee.hr_name);
                            $('#yourJobTitle').text(employee.hr_job_title);
                            $('#schoolNameFooter').text(employee.school_footer);
                        } else {
                            console.error('Employee details not found');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching employee details:', error);
                    }
                });
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
@endsection
