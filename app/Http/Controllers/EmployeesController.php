<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Employees;

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
        $employees = Employees::all();

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return '<button class="btn btn-info view-id-card" data-bs-toggle="modal"
                data-bs-target="#idCardModal" data-id="' . $employee->id . '"
                                                data-company-name="' . $employee->employee_name . '" data-designation="' . $employee->employee_role . '"
                                                data-phone="' . $employee->mobileno . '" data-address="' . $employee->permanent_address . '"
                                                data-email="' . $employee->email . '">View ID
                                                Card</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getJobOfferLetters(Request $request)
    {
        $employees = Employees::all();

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return'<button data-bs-toggle="modal"
                data-bs-target="#offerLetterModal" class="btn btn-info viewOffer" data-id="' . $employee->id . '">View Offer
                                                Letter</button>';

            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function getResignationLetters(Request $request)
    {
        $employees = Employees::all();

        return DataTables::of($employees)
            ->addColumn('actions', function ($employee) {
                return '<button class="btn btn-info view-resignation-btn" data-bs-toggle="modal"
                data-bs-target="#resignationLetterModal" data-name="' . $employee->employee_name . '"
                data-position="' . $employee->employee_role . '" data-date="' . $employee->doj.'" data-status="Pending"
                data-id="' . $employee->id . '">View</button>';

            })
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function show($id)
    {
        // Fetch employee data from database
        $employee = Employees::find($id); // Assuming you have an Employee model

        if ($employee) {
            return response()->json(['data' => $employee]);
        } else {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    }

}
