<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function allClassess()
    {
        return view('pages.classes.all_classes');
    }
    public function newClassess()
    {
        return view('pages.classes.new_classes');
    }
}
