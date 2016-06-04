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
        if (auth()->user()->can('admin')) {
            $courses = Course::all();
        } else {
            $courses = auth()->user()->courses()->get();
            $coursesThatTeach = auth()->user()->coursesThatTeach()->get();
            $courses = $courses->merge($coursesThatTeach);
        }
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $this->authorize('view-course', $course);

        return view('courses.show', compact('course'));
    }
}
