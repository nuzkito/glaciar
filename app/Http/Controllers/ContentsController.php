<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Content;
use App\Course;

class ContentsController extends Controller
{
    public function show($id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('view-course', $content->course);

        return view('contents.show', compact('content'));
    }

    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);
        $this->authorize('manage-course-contents', $course);

        return view('contents.create', compact('course'));
    }

    public function store(Request $request)
    {
        $course = Course::findOrFail($request->input('course_id'));
        $this->authorize('manage-course-contents', $course);

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $content = new Content($request->only(['title', 'body']));
        $content->course()->associate($course);
        $content->save();

        session()->flash('success', 'El contenido se ha publicado.');
        return redirect()->route('content.edit', $content->id);
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('manage-course-contents', $content->course);

        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('manage-course-contents', $content->course);

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $content->fill($request->only(['title', 'body']));
        $content->save();

        session()->flash('success', 'El contenido se ha editado.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $this->authorize('manage-course-contents', $content->course);
        $content->delete();

        session()->flash('success', 'El contenido se ha editado.');
        return redirect()->route('course.show', $content->course->id);
    }
}
