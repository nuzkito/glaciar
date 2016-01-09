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

        if (auth()->user()->cannot('view-course', $content->course)) {
            abort(403);
        }

        return view('contents.show', compact('content'));
    }

    public function create($course_id)
    {
        $course = Course::findOrFail($course_id);

        if (auth()->user()->cannot('manage-course-contents', $content)) {
            abort(403);
        }

        return view('contents.create', compact('course'));
    }

    public function store(Request $request)
    {
        $course = Course::findOrFail($request->input('course_id'));

        if (auth()->user()->cannot('manage-course-contents', $content)) {
            abort(403);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $content = new Content($request->only(['title', 'body']));
        $content->course()->associate($course);
        $content->save();

        session()->flash('success', 'El contenido se ha publicado.');
        return redirect('/contenidos/' . $content->id . '/editar');
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);

        if (auth()->user()->cannot('manage-course-contents', $content)) {
            abort(403);
        }

        return view('contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);

        if (auth()->user()->cannot('manage-course-contents', $content)) {
            abort(403);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $content->fill($request->only(['title', 'body']));
        $content->save();

        session()->flash('success', 'El contenido se ha editado.');
        return redirect()->back();
    }
}
