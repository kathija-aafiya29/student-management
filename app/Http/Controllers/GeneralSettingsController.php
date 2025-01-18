<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\Classes;

class GeneralSettingsController extends Controller
{
    public function customizeGrading()
    {
        return view('pages.general_settings.customize_grading');
    }
    public function feeStructure()
    {
        $castes=Caste::all();
        $classes=Classes::all();
        return view('pages.general_settings.fee_structure',compact('castes','classes'));

    }
    
}
