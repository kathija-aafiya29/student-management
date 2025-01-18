<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeStructure;
use App\Models\Caste;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;


class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $castes=Caste::all();
        $classes=Classes::all();
        if($request->ajax()){
            $class = $request->class;
            $feeType = $request->fee_type;
        
            $query = FeeStructure::query();
        
            if ($class) {
                $query->where('class_id', $class);
            }
        
            if ($feeType) {
                $query->where('fee_type', $feeType);
            }
        
            // Fetch grouped fees
            $feeStructures = $query->get()->groupBy('caste_id'); // Group by caste (Caste 1, Caste 2, etc.)
            // Transform data into a usable structure for frontend
            $response = [];
            foreach ($feeStructures as $caste => $fees) {
                $casteData = ['caste' => $caste];
                foreach ($fees as $fee) {
                    $casteData['Monthly Tuition Fee'] = $fee->monthly_tution_fee;
                    $casteData['Admission Fee'] = $fee->admission_fee;
                    $casteData['Registration Fee'] = $fee->registration_fee;
                    $casteData['Transport'] = $fee->transport;
                    $casteData['Books'] = $fee->books;
                    $casteData['Uniform'] = $fee->uniform;
                    $casteData['Others'] = $fee->others;
                    $casteData['Total Amount'] = $fee->total_amount;
                }
                $response[] = $casteData;
            }
        
            return response()->json($response);
        }
        return view('pages.general_settings.view_structure',compact('castes','classes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction(); // Start a database transaction
    
        try {
            $validated = $request->validate([
                'class_id' => 'required|exists:classes,id',
                'fee_type' => 'required|string|max:255',
                'caste_id' => 'required|exists:castes,id|unique:fee_structures,caste_id',
                'monthly_tution_fee' => 'required|numeric',
                'admission_fee' => 'required|numeric',
                'registration_fee' => 'required|numeric',
                'art_material' => 'required|numeric',
                'transport' => 'required|numeric',
                'books' => 'required|numeric',
                'uniform' => 'required|numeric',
                'others' => 'required|numeric',
                'total_amount' => 'required|numeric',
            ]);
    
            FeeStructure::create($validated);
            DB::commit();
            return response()->json(['message' => 'Fee Structure created successfully.'], 201);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
