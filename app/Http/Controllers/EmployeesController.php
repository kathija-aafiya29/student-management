<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeesController extends Controller
{
    public function allEmployees()
    {
        return view('pages.employees.all_employees');
    }
    public function employeeIdCard()
    {
        return view('pages.employees.employee_id_cards');
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
    public function getEmployeeIdCards(Request $request)
    {
        $employees = Employee::select(['id', 'name', 'department', 'position', 'created_at']);

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return '<button class="btn btn-primary view-id-card" data-id="' . $employee->id . '">View ID Card</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getJobOfferLetters(Request $request)
    {
        $employees = Employee::select(['id', 'name', 'job_offer_date', 'position', 'created_at']);

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return '<a href="/download/job-offer/' . $employee->id . '" class="btn btn-success">Download Offer</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getResignationLetters(Request $request)
    {
        $employees = Employee::select(['id', 'name', 'resignation_date', 'department', 'created_at']);

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return '<a href="/download/resignation/' . $employee->id . '" class="btn btn-danger">Download Resignation</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

}
