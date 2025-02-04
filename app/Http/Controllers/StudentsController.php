<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Students;
use App\Models\Classes;

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

    public function promoteDepromote(Request $request)
    {
        if ($request->ajax()) {
            $query = Students::join('classes', 'students.class', '=', 'classes.id')
                ->select('students.*', 'classes.class_name');

            // Apply class filter if selected
            if ($request->has('class_id') && $request->class_id != '') {
                $query->where('classes.id', $request->class_id);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('promotion', function ($row) {
                    $selectedPromote = $row->promote_status === 1 ? 'selected' : '';
                    $selectedDepromote = $row->promote_status === 0 ? 'selected' : '';

                    return '<select class="form-control form-control-sm" id="promotion_' . $row->id . '">
                                <option value="" ' . $selectedPromote . '>Select</option>
                                <option value="1" ' . $selectedPromote . '>Promote</option>
                                <option value="0" ' . $selectedDepromote . '>De-Promote</option>
                            </select>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-success btn-sm" onclick="submitPromotion('.$row->id.')">
                               <i class="mdi mdi-check"></i>
                            </button>';
                })
                ->rawColumns(['promotion', 'action'])
                ->make(true);
        }

        // Fetch classes for filter dropdown
        $classes = Classes::all();

        return view('pages.students.promote_depromote', compact('classes'));
    }
    public function newstudents()
    {
        $classes=Classes::all();

        return view('pages.students.new_students',compact('classes'));  
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
    
    public function updatePromotion(Request $request)
    {
        $student = Students::findOrFail($request->id);
        $student->promote_status = $request->status;
        $student->save();
    
        return response()->json(['message' => 'Student promotion status updated successfully!']);
    }
}
