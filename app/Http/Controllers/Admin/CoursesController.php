<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Course;
use App\User;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::paginate();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.courses.create', compact('users'));
    }

    public function store(CourseRequest $request)
    {
        $course = new Course($request->only(['name']));
        $course->save();
        $course->users()->sync($request->input('users'));
        $course->teachers()->sync($request->input('teachers'));

        session()->flash('success', 'El curso se ha creado.');
        return redirect()->route('admin.course.edit', $course->id);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $users = User::all();
        return view('admin.courses.edit', compact('course', 'users'));
    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->fill($request->only(['name']));
        $course->save();
        $course->users()->sync($request->input('users'));
        $course->teachers()->sync($request->input('teachers'));

        session()->flash('success', 'Los datos del curso se han actualizado.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        session()->flash('success', 'El curso ' . $course->name . ' se ha eliminado.');
        return redirect()->route('admin.course.index');
    }
}
