<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\GeneralSettingsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\EmployeeMasterController;
use App\Http\Controllers\StudentMasterController;

// Login and Logout Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LoginController::class, 'index'])->name('dashboard');

// Resource Routes
// Route::resource('classes', ClassesController::class);
// Route::resource('settings', GeneralSettingsController::class);
Route::resource('studentsMaster', StudentMasterController::class);
Route::resource('employeesMaster', EmployeeMasterController::class);

// Custom Routes for GeneralSettingsController (if needed)
Route::get('/settings/customize-grading', [GeneralSettingsController::class, 'customizeGrading'])->name('settings.customizeGrading');
Route::get('/settings/fee-structure', [GeneralSettingsController::class, 'feeStructure'])->name('settings.feeStructure');
Route::get('/settings/view-structure', [GeneralSettingsController::class, 'viewStructure'])->name('settings.viewStructure');

// Custom Routes for StudentsController (if needed)
Route::get('/students/all', [StudentsController::class, 'allStudents'])->name('students.allStudents');
Route::get('/students/id-card', [StudentsController::class, 'studentIdCard'])->name('students.studentIdCard');
Route::get('/students/admission-letter', [StudentsController::class, 'admissionLetter'])->name('students.admissionLetter');
Route::get('/students/promote-depromote', [StudentsController::class, 'promoteDepromote'])->name('students.promoteDepromote');
Route::get('/students/new', [StudentsController::class, 'newStudents'])->name('students.newStudents');
Route::get('/students/list', [StudentsController::class, 'studentList'])->name('students.studentList');

// Custom Routes for EmployeesController (if needed)
Route::get('/employees/all', [EmployeesController::class, 'allEmployees'])->name('employees.allEmployees');
Route::get('/employees/id-card', [EmployeesController::class, 'employeeIdCard'])->name('employees.employeeIdCard');
Route::get('/employees/job-offer-letter', [EmployeesController::class, 'jobOfferLetter'])->name('employees.jobOfferLetter');
Route::get('/employees/job-resignation', [EmployeesController::class, 'jobResignation'])->name('employees.jobResignation');
Route::get('/employees/new', [EmployeesController::class, 'newEmployees'])->name('employees.newEmployees');
Route::get('/employees/replacing-staff', [EmployeesController::class, 'replacingStaff'])->name('employees.replacingStaff');

// Custom Routes for ClassesController (if needed)
Route::get('/classes/all', [ClassesController::class, 'allClasses'])->name('classes.allClasses');
Route::get('/classes/new', [ClassesController::class, 'newClasses'])->name('classes.newClasses');
