@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/id_card.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Student ID Card</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Student</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student ID Card</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Student List</h4>
                            <!-- Employee Table -->
                            <table id="studentTable" class="table table-striped">
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
                                        <td><button class="btn btn-info view-id-card" data-id="1"data-company-name="Raju"
                                                data-designation="X-class " data-phone="+91 8980849796"
                                                data-address="Part-1, 89 Harinadad Rd"
                                                data-email="Planicsdeveloper@gmail.com">View ID
                                                Card</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane</td>
                                        <td>Smith</td>
                                        <td>Data Analyst</td>
                                        <td><button class="btn btn-info view-id-card"
                                                data-id="2"data-company-name="Balaji" data-designation="XII-Class"
                                                data-phone="+91 8980849796" data-address="Part-1, 89 Harinadad Rd"
                                                data-email="Planicsdeveloper@gmail.com">View ID
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
        <!-- partial -->
    </div>

    <!-- main-panel ends -->

    <!-- page-body-wrapper ends -->
    <div class="modal fade" id="idCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Student ID Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="id_card_content" style="background-color: #e6ebe0;">

                    <div class="overall-container">
                        <div class="custom-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="custom-padding">
                                        <div id="front-card" class="custom-font">
                                            <div class="custom-top">
                                                <img src="{{ asset('assets/images/id_card/download.png') }}"
                                                    alt="Profile Picture">
                                            </div>
                                            <div class="custom-bottom">
                                                <p id="company-name">Default Company</p>
                                                <p id="designation" class="custom-desi">Default Designation</p>
                                                <div class="custom-barcode">
                                                    <img src="{{ asset('assets/images/id_card/qr_sample.png') }}"
                                                        alt="QR Code">
                                                </div>
                                                <br>
                                                <p id="phone" class="custom-no">+00 0000000000</p>
                                                <p id="address" class="custom-no">Default Address</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="back-card" class="custom-back">
                                        <h1 class="custom-details">Information</h1>
                                        <hr>
                                        <div id="back-details" class="custom-details-info">
                                            <p><b>Email:</b></p>
                                            <p id="email">default@example.com</p>
                                        </div>
                                        <div class="custom-logo">
                                            <img src="{{ asset('assets/images/id_card/barcode.png') }}">
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="download-pdf">Download ID
                        Card</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- endinject -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#studentTable').DataTable(
                //             {
                //     processing: true,
                //     serverSide: true,
                //     ajax: "{{ route('datatable.students.idcards') }}",
                //     columns: [
                //         { data: 'id', name: 'id' },
                //         { data: 'name', name: 'name' },
                //         { data: 'class', name: 'class' },
                //         { data: 'roll_number', name: 'roll_number' },
                //         { data: 'created_at', name: 'created_at' },
                //         { data: 'actions', name: 'actions', orderable: false, searchable: false },
                //     ]
                // }
            );

            // View Employee ID Card button click
            $('.view-id-card').on('click', function() {
                const employeeId = $(this).data('id');
                // Fetch employee details (for simplicity, using static data here)
                const companyName = $(this).data('company-name');
                const designation = $(this).data('designation');
                const phone = $(this).data('phone');
                const address = $(this).data('address');
                const email = $(this).data('email');

                // Update the front card details
                $('#company-name').text(companyName);
                $('#designation').text(designation);
                $('#phone').text(phone);
                $('#address').text(address);

                // Update the back card details
                $('#email').text(email);
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
                        doc.save('Student_ID_Card.pdf');
                    }
                });
            });
        });
    </script>
@endsection
