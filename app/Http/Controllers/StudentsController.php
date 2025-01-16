<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
        $students = Student::select(['id', 'name', 'class', 'roll_number', 'created_at']);

        return DataTables::of($students)
            ->addColumn('actions', function ($student) {
                return '<button class="btn btn-primary view-id-card" data-id="' . $student->id . '">View ID Card</button>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
