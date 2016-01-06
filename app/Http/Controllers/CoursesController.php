<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->get();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);

        if (auth()->user()->cannot('view-course', $course)) {
            abort(403);
        }

        return view('courses.show', compact('course'));
    }

    public function questions($id)
    {
        $course = Course::findOrFail($id);

        if (auth()->user()->cannot('view-course', $course)) {
            abort(403);
        }

        return view('courses.questions', compact('course'));
    }
}
