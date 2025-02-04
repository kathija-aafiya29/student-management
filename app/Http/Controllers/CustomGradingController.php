<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomGrading;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CustomGradingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomGrading::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status ? 'Pass' : 'Fail';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-warning btn-sm" onclick="openModal('.$row->id.')"><i class="mdi mdi-table-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteGrading('.$row->id.')"><i class="mdi mdi-delete"></i></button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        try{
            $data = $request->validate([
                'grade' => 'required|string|max:50',
                'from' => 'required|numeric',
                'to' => 'required|numeric|gt:from',
                'status' => 'required|boolean',
            ]);

            $data['created_by'] = Auth::id();
            $grading = CustomGrading::create($data);

            return response()->json(['success' => 'Grading Added Successfully!', 'data' => $grading]);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error'   => 'Validation failed.',
                'details' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
    
            return response()->json(['error' => 'Failed to save Grade', 'details' => $e->getMessage()], 500);
        }
    }


    public function edit($id)
    {
        return response()->json(CustomGrading::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        try{
            $data = $request->validate([
                'grade' => 'required|string|max:50',
                'from' => 'required|numeric|max:100',
                'to' => 'required|numeric|max:100|gt:from',
                'status' => 'required|boolean',
            ]);

            $data['updated_by'] = Auth::id();
            $grading = CustomGrading::findOrFail($id);
            $grading->update($data);

            return response()->json(['success' => 'Grading Updated Successfully!', 'data' => $grading]);

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error'   => 'Validation failed.',
                'details' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Failed to save Grade', 'details' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        CustomGrading::findOrFail($id)->delete();
        return response()->json(['success' => 'Grading Deleted Successfully!']);
    }
}

