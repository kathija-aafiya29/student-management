<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="/assets/images/faces/face1.jpg" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">David Grey. H</span>
            <span class="text-secondary text-small">Class Teacher</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">General Settings</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-settings menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('settings.feeStructure') }}">Fees Structure</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('feeStructure.index') }}">View Structure</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('settings.customizeGrading') }}">Customize Grading</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-emp" aria-expanded="false" aria-controls="ui-emp">
                <span class="menu-title">Employees</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-outline menu-icon"></i>
            </a>
            <div class="collapse" id="ui-emp">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employeesMaster.index') }}">All Employees</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.newEmployees') }}">New Employee</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.jobOfferLetter') }}">Job Offer Letter</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.jobResignation') }}">Job Resignation</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.employeeIdCard') }}">Employee Id cards</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('employees.replacingStaff') }}">Replacing Staffs</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-classes" aria-expanded="false" aria-controls="ui-classes">
                <span class="menu-title">Classes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-school menu-icon"></i>
            </a>
            <div class="collapse" id="ui-classes">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('classes.allClasses') }}">All Classes</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('classes.newClasses') }}">New Classes</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-students" aria-expanded="false" aria-controls="ui-students">
                <span class="menu-title">Students</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-human-child menu-icon"></i>
            </a>
            <div class="collapse" id="ui-students">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('studentsMaster.index') }}">All Students</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('students.newStudents') }}">New Students</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('students.admissionLetter') }}">Admission Letter</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('students.studentIdCard') }}">Student Id cards</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('students.studentList') }}">Student List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('students.promoteDepromote') }}">Promote/De-Promote Students</a></li>
                </ul>
            </div>
        </li>
    </ul>
  </nav>
