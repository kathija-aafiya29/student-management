<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function allClasses()
    {
        $classes = Classes::all();
        return view('pages.classes.all_classes', compact('classes'));
    }
    public function newClasses()
    {
        return view('pages.classes.new_classes');
    }
    public function checkAndInsert(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'class_code' => 'required|string|max:255|unique:classes,class_code',
            'total_students' => 'required|integer|min:1',
            'boys' => 'required|integer|min:0',
            'girls' => 'required|integer|min:0',
        ]);

        // Check if the class already exists
        $exists = Classes::where('class_code', $request->class_code)->exists();
        if ($exists) {
            return response()->json(['exists' => true], 200);
        }

        // Insert the new class
        Classes::create([
            'class_name' => $request->class_name,
            'section' => $request->section,
            'class_code' => $request->class_code,
            'total_students' => $request->total_students,
            'no_of_boys' => $request->boys,
            'no_of_girls' => $request->girls,
        ]);

        return response()->json(['exists' => false], 200);
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'no_of_boys' => 'required|integer|min:0',
            'no_of_girls' => 'required|integer|min:0',
        ]);

        $class = Classes::findOrFail($validated['class_id']);
        $class->no_of_boys = $validated['no_of_boys'];
        $class->no_of_girls = $validated['no_of_girls'];
        $class->total_students = $validated['no_of_boys'] + $validated['no_of_girls']; // Calculate total students
        $class->save();


        return response()->json([
            'success' => true,
            'message' => 'Class details updated successfully!',
        ]);
    }


}
