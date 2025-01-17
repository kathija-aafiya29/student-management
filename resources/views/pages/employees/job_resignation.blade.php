@extends('layouts.layout')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> Job Resignation </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Employees</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Job Resignation</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Employee Table</h4>
                            <table id="resignationTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Staff Name</th>
                                        <th>Position</th>
                                        <th>Resignation Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>Teacher</td>
                                        <td>2025-02-15</td>
                                        <td><label class="badge badge-warning">Pending</label></td>
                                        <td><button class="btn btn-info view-resignation-btn" data-bs-toggle="modal"
                                                data-bs-target="#resignationLetterModal" data-name="John Doe"
                                                data-position="Teacher" data-date="2025-02-15" data-status="Pending"
                                                data-id="1">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td>Administrator</td>
                                        <td>2025-03-01</td>
                                        <td><label class="badge badge-success">Approved</label></td>
                                        <td><button class="btn btn-info view-resignation-btn" data-bs-toggle="modal"
                                                data-bs-target="#resignationLetterModal" data-name="Jane Smith"
                                                data-position="Administrator" data-date="2025-03-01" data-status="Approved"
                                                data-id="2">View</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Michael Brown</td>
                                        <td>Manager</td>
                                        <td>2025-01-10</td>
                                        <td><label class="badge badge-danger">Rejected</label></td>
                                        <td><button class="btn btn-info view-resignation-btn" data-bs-toggle="modal"
                                                data-bs-target="#resignationLetterModal" data-name="Michael Brown"
                                                data-position="Manager" data-date="2025-01-10" data-status="Rejected"
                                                data-id="3">View</button></td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="resignationLetterModal" tabindex="-1" aria-labelledby="resignationLetterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resignationLetterModalLabel">Resignation Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="resignation_letter" style="border: 1px solid #ccc; padding: 20px; margin-bottom: 20px;">
                        <h2 style="text-align: center;">Resignation Letter</h2>
                        <p>Dear <span id="managerName">[Manager Name]</span>,</p>
                        <p>I am writing to formally resign from my position as <strong><span id="staffTitlepo">[Position
                                    Title]</span></strong> at
                            <strong><span id="schoolName">[Company Name]</span></strong>, effective on <strong><span
                                    id="resignationDate">[Resignation Date]</span></strong>.
                        </p>
                        <p>This decision has not been an easy one, but after careful consideration, I believe it is
                            the right time for me to pursue new opportunities and personal growth.</p>
                        <p>I would like to express my sincere gratitude for the opportunities for professional and
                            personal development that you have provided me during my time with the company. It has
                            been a pleasure working with you and the entire team, and I truly appreciate the support
                            and guidance I have received.</p>
                        <p>In the next few weeks, I am happy to assist in the transition process and ensure a smooth
                            handover of my responsibilities.</p>
                        <p>Thank you again for the opportunity to be part of the <strong><span
                                    id="companyNameFooter">[Company Name]</span></strong> team, and I wish the
                            company continued success in the future.</p>
                        <p>Sincerely,</p>
                        <p><strong><span id="staffName">[Staff Name]</span></strong></p>
                        <p><strong><span id="staffTitle">[Staff Title]</span></strong></p>
                        <p><strong><span id="schoolNamefotter">[Company Name]</span></strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="download-resignation-pdf" class="btn btn-primary">Download PDF</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#resignationTable').DataTable(
                //     {
                //     processing: true,
                //     serverSide: true,
                //     ajax: "{{ route('datatable.employees.resignations') }}",
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

            // View Resignation Letter button click
            $('.view-resignation-btn').on('click', function() {
                const employeeId = $(this).data('id');

                // Fetch employee details (here, using static data for simplicity)
                if (employeeId === 1) {
                    $('#staffName').text('John Doe');
                    $('#staffTitlepo').text('Teacher');
                    $('#staffTitle').text('Teacher');
                    $('#schoolName').text('Tech High School');
                    $('#schoolNamefotter').text('Tech High School');
                    $('#resignationDate').text('2025-02-15');
                    $('#status').text('Pending');
                    $('#managerName').text('Alice Johnson');
                    $('#schoolLocation').text('New York');
                    $('#companyNameFooter').text('Tech High School');
                } else if (employeeId === 2) {
                    $('#staffName').text('Jane Smith');
                    $('#staffTitle').text('Administrator');
                    $('#schoolName').text('Data Academy');
                    $('#resignationDate').text('2025-03-01');
                    $('#status').text('Approved');
                    $('#managerName').text('Tom Green');
                    $('#schoolLocation').text('San Francisco');
                    $('#companyNameFooter').text('Data Academy');
                }

                // Show modal
                $('#resignationLetterModal').modal('show');
            });

            // Download PDF button click
            $('#download-resignation-pdf').on('click', function() {
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Get the content of the resignation letter
                const resignationLetter = document.getElementById('resignation_letter');

                // Use html2canvas with the callback approach
                html2canvas(resignationLetter, {
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
                        doc.save('Resignation_Letter.pdf');
                    }
                });
            });
        });
    </script>
@endsection
