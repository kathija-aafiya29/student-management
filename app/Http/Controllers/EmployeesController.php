<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function allEmployees()
    {
        return view('pages.employees.all_employees');
    }
    public function employeeIdCard()
    {
        return view('pages.employees.employee_id_card');
    }
    public function jobOfferLetter()
    {
        return view('pages.employees.job_offer_letter');
    }
    public function jobResignation()
    {
        return view('pages.employees.job_resignation');
    }
    public function newEmployees()
    {
        return view('pages.employees.new_employees');
    }
    public function replacingStaff()
    {
        return view('pages.employees.replacing_staff');
    }
}
