<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->get();
        return view('courses.index', compact('courses'));
    }
}
