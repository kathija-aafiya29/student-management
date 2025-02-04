<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\CustomGradingController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EmployeeMasterController;
use App\Http\Controllers\StudentMasterController;
use App\Http\Controllers\FeeStructureController;

// Login and Logout Routes
Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/authLogin', [LoginController::class, 'login'])->name('authLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LoginController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
// Resource Routes
Route::resource('classesMaster', ClassesController::class);
// Route::resource('settings', GeneralSettingsController::class);
Route::resource('studentsMaster', StudentMasterController::class);
Route::resource('employeesMaster', EmployeeMasterController::class);
Route::resource('feeStructure', FeeStructureController::class);
Route::resource('customGrading', CustomGradingController::class);

// Custom Routes for GeneralSettingsController (if needed)
Route::get('/settings/customize-grading', [GeneralSettingsController::class, 'customizeGrading'])->name('settings.customizeGrading');
Route::get('/settings/fee-structure', [GeneralSettingsController::class, 'feeStructure'])->name('settings.feeStructure');

// Custom Routes for StudentsController (if needed)
Route::get('/students/allstudents', [StudentsController::class, 'allStudents'])->name('students.allStudents');
Route::get('/students/id-card-student', [StudentsController::class, 'studentIdCard'])->name('students.studentIdCard');
Route::get('/students/admission-letter', [StudentsController::class, 'admissionLetter'])->name('students.admissionLetter');
Route::get('/students/promote-depromote', [StudentsController::class, 'promoteDepromote'])->name('students.promoteDepromote');
Route::post('/students/update-promotion', [StudentsController::class, 'updatePromotion'])->name('students.updatePromotion');
Route::get('/students/newStudent', [StudentsController::class, 'newStudents'])->name('students.newStudents');
Route::get('/students/listStudent', [StudentsController::class, 'studentList'])->name('students.studentList');
Route::post('studentsMaster/{id}/toggle-status', [StudentMasterController::class, 'toggleStatus']);

// Custom Routes for EmployeesController (if needed)
Route::get('/employees/allEmployee', [EmployeesController::class, 'allEmployees'])->name('employees.allEmployees');
Route::get('/employees/id-card-employee', [EmployeesController::class, 'employeeIdCard'])->name('employees.employeeIdCard');
Route::get('/employees/job-offer-letter', [EmployeesController::class, 'jobOfferLetter'])->name('employees.jobOfferLetter');
Route::get('/employees/job-resignation', [EmployeesController::class, 'jobResignation'])->name('employees.jobResignation');
Route::get('/employees/newemployee', [EmployeesController::class, 'newEmployees'])->name('employees.newEmployees');
Route::get('/employees/replacing-staff', [EmployeesController::class, 'replacingStaff'])->name('employees.replacingStaff');
Route::get('/employees/show/{id}', [EmployeesController::class, 'show'])->name('employees.show');
Route::post('employeesMaster/{id}/toggle-status', [EmployeeMasterController::class, 'toggleStatus']);



// Custom Routes for ClassesController (if needed)
Route::get('/classes/allClass', [ClassesController::class, 'allClasses'])->name('classes.allClasses');
Route::get('/classes/newClass', [ClassesController::class, 'newClasses'])->name('classes.newClasses');
Route::post('/classes/check-and-insert', [ClassesController::class, 'checkAndInsert'])->name('classes.checkAndInsert');
Route::put('/classes/update', [ClassesController::class, 'update'])->name('classes.updateClass');


//Datatable
Route::get('/students/datatable/student-id-cards', [StudentsController::class, 'getStudentIdCards'])->name('datatable.students.idcards');
Route::get('/employees/datatable/employee-id-cards', [EmployeesController::class, 'getEmployeeIdCards'])->name('datatable.employees.idcards');
Route::get('/employees/datatable/employee-job-offer-letters', [EmployeesController::class, 'getJobOfferLetters'])->name('datatable.employees.joboffers');
Route::get('/employees/datatable/employee-resignation-letters', [EmployeesController::class, 'getResignationLetters'])->name('datatable.employees.resignations');

});