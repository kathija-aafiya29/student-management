<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
