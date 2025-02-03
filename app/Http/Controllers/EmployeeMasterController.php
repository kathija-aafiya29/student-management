<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeMasterController extends Controller
{
    public function store(Request $request)
        {
        DB::beginTransaction(); // Start a database transaction

        try {
            $validated = $request->validate([
                'employee_name' => 'required|string|max:255',
                'employee_role' => 'required|string|max:100',
                'dob' => 'required|date',
                'gender' => 'required|string|max:10',
                'email' => 'required|email|unique:employees,email',
                'blood_grp' => 'required|string|max:3',
                'marital_status' => 'required|string|max:20',
                'emp_relative_name' => 'required|string|max:255',
                'religion' => 'required|string|max:50',
                'community' => 'required|string|max:50',
                'nationality' => 'required|string|max:50',
                'education' => 'required|string|max:255',
                'experience' => 'required|max:255',
                'doj' => 'required|date',
                'monthly_salary' => 'required|numeric',
                'aadharno' => 'required|string|max:12|unique:employees,aadharno',
                'mobileno' => 'required|string|max:15|unique:employees,mobileno',
                'alt_mobileno' => 'nullable|string|max:15',
                'mobileno_wp_status' => 'nullable|bool',
                'alt_mobileno_wp_status' => 'nullable|bool',
                'permanent_address' => 'required|string',
                'current_address' => 'nullable|string',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
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
                'name' => $validated['employee_name'],
                'email' => $validated['email'],
                'password' => Hash::make('123'),
                'role' => 'employee',
            ]);

            // Create an employee record
            $validated['user_id'] = $user->id;
            $validated['profile_picture'] =$filePath ?? null;
            Employees::create($validated);
            DB::commit();
            return response()->json(['message' => 'Employee and user record created successfully.'], 201);
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

    // Fetch all employees
    public function index()
    {
        $employees = Employees::all();
        return view('pages.employees.all_employees', compact('employees'));
    }

    // Update an employee
    public function update(Request $request, string $id)
    {
        DB::beginTransaction(); // Start transaction
        try {
            $employee = Employees::findOrFail($id); // Fetch employee
            $user = User::findOrFail($employee->user_id); // Fetch associated user
            
            $validated = $request->validate([
                'employee_name' => 'required|string|max:255',
                'employee_role' => 'required|string|max:100',
                'dob' => 'required|date',
                'gender' => 'required|string|max:10',
                'email' => 'required|email|unique:users,email,' . $user->id, // Ignore current user's email
                'blood_grp' => 'required|string|max:3',
                'marital_status' => 'required|string|max:20',
                'emp_relative_name' => 'required|string|max:255',
                'religion' => 'required|string|max:50',
                'community' => 'required|string|max:50',
                'nationality' => 'required|string|max:50',
                'education' => 'required|string|max:255',
                'experience' => 'required|max:255',
                'doj' => 'required|date',
                'monthly_salary' => 'required|numeric',
                'aadharno' => 'required|string|max:12|unique:employees,aadharno,' . $id, // Ignore current employee's Aadhaar
                'mobileno' => 'required|string|max:15|unique:employees,mobileno,' . $id, // Ignore current employee's mobile
                'alt_mobileno' => 'nullable|string|max:15',
                'mobileno_wp_status' => 'nullable|boolean',
                'alt_mobileno_wp_status' => 'nullable|boolean',
                'permanent_address' => 'required|string',
                'current_address' => 'nullable|string',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

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

                // Delete old profile picture if it exists
                if ($employee->profile_picture && file_exists(storage_path('app/public/' . $employee->profile_picture))) {
                    unlink(storage_path('app/public/' . $employee->profile_picture));
                }

                $validated['profile_picture'] = $filePath;
            }
            // Update user record
            $user->update([
                'name' => $validated['employee_name'],
                'email' => $validated['email'],
            ]);

            // Update employee record
            $employee->update($validated);

            DB::commit();
            return response()->json(['message' => 'Employee record updated successfully.'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Validation failed.',
                'details' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Failed to update employee record.',
                'details' => $e->getMessage(),
            ], 500);
        }
       
    }


    // Delete an employee
    public function destroy(string $id)
    {
        // Delete user record
        $employee= Employees::findOrFail($id);

        // Delete employee record
        $employee->delete();

        return response()->json(['message' => 'Employee and user record deleted successfully.'], 200);
    }

    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        return view('pages.employees.employee_edit_form', compact('employee'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $employee = Employees::findOrFail($id);

        // Toggle the employee status (0 = inactive, 1 = active)
        $employee->active_status = !$employee->active_status;

        if ($employee->save()) {
            return response()->json(['message' => 'Employee status updated successfully']);
        }

        return response()->json(['message' => 'Failed to update employee status'], 500);
    }

}
