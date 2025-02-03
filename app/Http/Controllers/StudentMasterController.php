<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class StudentMasterController extends Controller
{
    public function index()
    {
        $students = Students::join('classes', 'students.class', '=', 'classes.id')
            ->get();
    
        return view('pages.students.all_students', compact('students'));
    }
    

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in the database.
     */
    public function store(Request $request)
    {
     DB::beginTransaction(); // Start a database transaction

        try {
            $validated = $this->validateStudent($request);

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $destinationPath = storage_path('app/public/assets/profiles');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); 
                }
                $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Generate a unique name
                $file->move($destinationPath, $fileName); // Move the file
                // File path to store in the database
                $filePath = 'profiles/' . $fileName;

            }
        
            // Create a user record
            $user = User::create([
                'name' => $validated['student_name'],
                'email' => $validated['email'],
                'password' => Hash::make('123'), 
                'role' => 'student',
            ]);

            // Create an employee record
            $validated['user_id'] = $user->id;
            $validated['profile_picture'] =$filePath ?? null;
    
            Students::create($validated);
            DB::commit();
            return response()->json(['message' => 'Student record created successfully.'], 201);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $e->errors() // Returns the specific validation errors
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an error

            // Optionally, delete the uploaded file if it exists
            if (isset($filePath) && file_exists(storage_path('app/public/assets' . $filePath))) {
                unlink(storage_path('app/public/' . $filePath));
            }

            return response()->json(['error' => 'Failed to create employee record.', 'details' => $e->getMessage()], 500);
        }
    }
    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(string $id)
    {
        $student = Students::find($id);
        $classes = Classes::all();
        return view('pages.students.edit_student_form', compact('student','classes'));
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction(); // Start a transaction
    
        try {
            $student = Students::findOrFail($id); // Find student
            $validated = $this->validateStudent($request, $id);
    
            // Handle profile picture update
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $destinationPath = storage_path('app/public/assets/profiles');
    
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $fileName = uniqid() . '_' . $file->getClientOriginalName();
                $file->move($destinationPath, $fileName);
                $filePath = 'profiles/' . $fileName;
    
                // Delete old profile picture if exists
                if ($student->profile_picture && file_exists(storage_path('app/public/' . $student->profile_picture))) {
                    unlink(storage_path('app/public/' . $student->profile_picture));
                }
    
                $validated['profile_picture'] = $filePath;
            }
    
            // Update student record
            $student->update($validated);
    
            // Update user email if changed
            $student->user->update([
                'name'  => $validated['student_name'],
                'email' => $validated['email'],
            ]);
    
            DB::commit();
            return response()->json(['message' => 'Student record updated successfully.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error'   => 'Validation failed.',
                'details' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
    
            return response()->json(['error' => 'Failed to update student record.', 'details' => $e->getMessage()], 500);
        }
    }
    

    /**
     * Remove the specified student from the database.
     */
    public function destroy( string $id)
    {
        $student = Students::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully.']);
    }


    /**
     * Validation logic.
     */
    private function validateStudent(Request $request, $id = null)
    {
        return $request->validate([
            'student_name'           => 'required|string|max:100',
            'class'                  => 'required|exists:classes,id',
            'dob'                    => 'required|date',
            'email' => 'required|email|unique:students,email,' . $id,
            'gender'                 => 'required|in:Male,Female,Other',
            'religion'               => 'required|string|max:50',
            'community'              => 'required|string|max:50',
            'nationality'            => 'required|string|max:50',
            'orphan_student_status'  => 'boolean',
            'birth_id'               => 'required|string|max:50|unique:students,birth_id,' . $id,
            'aadharno'               => 'required|string|digits:12|unique:students,aadharno,' . $id,
            'identification_mark'    => 'required|string|max:255',
            'previous_school'        => 'required|string|max:100',
            'total_siblings'         => 'required|integer|min:0',
            'blood_grp'              => 'required|string|max:5',
            'disease_status'         => 'boolean',
            'doa'                    => 'required|date',
            'discount_fee'           => 'required|numeric|min:0',
            'profile_picture'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'permanent_address'      => 'required|string',
            'current_address'        => 'nullable|string',
            'father_name'            => 'required|string|max:100',
            'father_aadhaar_no'      => 'required|string|digits:12|unique:students,father_aadhaar_no,' . $id,
            'father_occupation'      => 'required|string|max:50',
            'father_mobile_no'       => 'required|string|digits_between:10,15',
            'father_mobile_status_wp'=> 'boolean',
            'father_income'          => 'required|numeric|min:0',
            'mother_name'            => 'required|string|max:100',
            'mother_aadhaar_no'      => 'required|string|digits:12|unique:students,mother_aadhaar_no,' . $id,
            'mother_occupation'      => 'required|string|max:50',
            'mother_mobile_no'       => 'required|string|digits_between:10,15',
            'mother_mobile_status_wp'=> 'boolean',
            'mother_income'          => 'required|numeric|min:0',
            'active_status'          => 'boolean',
        ]);
    }
    public function toggleStatus(Request $request, $id)
    {
        $student = Students::findOrFail($id);

        // Toggle the student status (0 = inactive, 1 = active)
        $student->active_status = !$student->active_status;

        if ($student->save()) {
            return response()->json(['message' => 'Student status updated successfully']);
        }

        return response()->json(['message' => 'Failed to update Student status'], 500);
    }
}
