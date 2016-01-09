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
        $questions = $course->questions()->paginate();

        if (auth()->user()->cannot('view-course', $course)) {
            abort(403);
        }

        return view('questions.index', compact('course', 'questions'));
    }

    public function show($id)
    {
        $question = Question::findOrFail($id);

        if (auth()->user()->cannot('view-course', $question->course)) {
            abort(403);
        }

        return view('questions.show', compact('question'));
    }
}
