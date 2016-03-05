<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\Question;

class QuestionsController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);
        $this->authorize('view-course', $course);
        $questions = $course->questions()->orderBy('created_at', 'desc')->paginate();

        return view('questions.index', compact('course', 'questions'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('view-course', $question->course);

        return view('questions.show', compact('question'));
    }

    public function store(Request $request)
    {
        $course = Course::findOrFail($request->input('course_id'));
        $this->authorize('view-course', $course);

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => '',
        ]);

        $question = new Question($request->only(['title', 'body']));
        $question->course()->associate($course);
        $question->user()->associate(auth()->user());
        $question->save();

        session()->flash('success', 'La pregunta ha sido enviada');
        return redirect()->back();
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('edit-question', $question);

        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $this->authorize('edit-question', $question);

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => '',
        ]);

        $question->fill($request->only(['title', 'body']))->save();

        session()->flash('success', 'La pregunta ha sido editada.');
        return redirect()->back();
    }
}
