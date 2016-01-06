<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::paginate();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $course = new Course($request->only(['name']));
        $course->save();

        session()->flash('success', 'El curso se ha creado.');
        return redirect('/admin/cursos/' . $course->id . '/edit');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        Course::findOrFail($id)->fill($request->only(['name']))->save();

        session()->flash('success', 'Los datos del curso se han actualizado.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        session()->flash('success', 'El curso ' . $course->name . ' se ha eliminado.');
        return redirect('/admin/cursos');
    }
}
