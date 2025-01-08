<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    public function customizeGrading()
    {
        return view('pages.general_settings.customize_grading');
    }
    public function feeStructure()
    {
        return view('pages.general_settings.fee_structure');
    }
    public function viewStructure()
    {
        return view('pages.general_settings.view_structure');
    }
}
