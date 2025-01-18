<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Students;

class StudentsController extends Controller
{
    public function allStudents()
    {
        return view('pages.students.all_students');
    }
    public function studentIdCard()
    {
        return view('pages.students.student_id_card');
    }
    public function admissionLetter()
    {
        return view('pages.students.admission_letter');
    }
    public function promoteDepromote()
    {
        return view('pages.students.promote_depromote');
    }
    public function newstudents()
    {
        return view('pages.students.new_students');
    }
    public function studentList()
    {
        return view('pages.students.student_list');
    }
    public function getStudentIdCards(Request $request)
    {
        $students = Students::all();

        return DataTables::of($students)
            ->addColumn('actions', function ($student) {
                return '<button class="btn btn-info view-id-card" data-bs-toggle="modal"
                data-bs-target="#idCardModal" data-id="' . $student->id . '"
                                                data-company-name="' . $student->student_name . '" data-designation="' . $student->class . '"
                                                data-phone="' . $student->father_mobile_no . '" data-address="' . $student->permanent_address . '"
                                                data-email="' . $student->email . '">View ID
                                                Card</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
