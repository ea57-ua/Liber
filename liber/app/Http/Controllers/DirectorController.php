<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function showDirectorInfo($id)
    {
        return view('directors.directorDetails');
    }
}
