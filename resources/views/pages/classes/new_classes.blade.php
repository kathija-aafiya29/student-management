@extends('layouts.layout')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title"> New Classes </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Classes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New Classes</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">New Class</h4>
                            <form id="insertClassForm" class="form-sample" method="POST">
                                @csrf
                                <p class="card-description">Class Info</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Class Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="className" class="form-control"
                                                    placeholder="Enter Class Name" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Section</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="section" class="form-control"
                                                    placeholder="Enter Section" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Class Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="classCode" class="form-control" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="card-description">Students Info</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">Total Students</label>
                                            <div class="col-sm-7">
                                                <input type="number" id="totalStudents" class="form-control"
                                                    placeholder="Enter Total Students" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">No. of Boys</label>
                                            <div class="col-sm-7">
                                                <input type="number" id="numberOfBoys" class="form-control"
                                                    placeholder="Enter No. of Boys" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label class="col-sm-5 col-form-label">No. of Girls</label>
                                            <div class="col-sm-7">
                                                <input type="number" id="numberOfGirls" class="form-control"
                                                    placeholder="Enter No. of Girls" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="#" class="btn btn-light">Cancel</a>
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Auto-generate class code
            $("#className, #section").on("keyup", function() {
                const className = $("#className").val().trim();
                const section = $("#section").val().trim();
                if (className && section) {
                    const classCode = `${className}_${section}`.toUpperCase().replace(/\s+/g, "");
                    $("#classCode").val(classCode);
                } else {
                    $("#classCode").val("");
                }
            });

            // AJAX submission with validation
            $("#insertClassForm").on("submit", function(e) {
                e.preventDefault();

                const className = $("#className").val().trim();
                const section = $("#section").val().trim();
                const classCode = $("#classCode").val().trim();
                const totalStudents = parseInt($("#totalStudents").val());
                const numberOfBoys = parseInt($("#numberOfBoys").val());
                const numberOfGirls = parseInt($("#numberOfGirls").val());

                if (!className || !section || !classCode) {
                    alert("Class Name, Section, and Class Code are required!");
                    return;
                }

                if (!totalStudents || totalStudents <= 0) {
                    alert("Total Students must be greater than 0!");
                    return;
                }

                if (numberOfBoys + numberOfGirls !== totalStudents) {
                    alert("The sum of Boys and Girls must equal the Total Students!");
                    return;
                }

                $.ajax({
                    url: "{{ route('classes.checkAndInsert') }}",
                    type: "POST",
                    data: {
                        class_name: className,
                        section: section,
                        class_code: classCode,
                        total_students: totalStudents,
                        boys: numberOfBoys,
                        girls: numberOfGirls,
                    },
                    success: function(response) {
                        if (response.exists) {
                            alert("Class already exists!");
                        } else {
                            alert("Class added successfully!");
                            // Reset form
                            $("#insertClassForm")[0].reset();
                            $("#classCode").val("");
                        }
                    },
                    error: function(error) {
                        alert("An error occurred. Please try again!");
                    },
                });
            });
        });
    </script>
@endsection
