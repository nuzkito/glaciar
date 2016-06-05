<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;

class QuestionVotesController extends Controller
{
    public function store($id)
    {
        $question = Question::findOrFail($id);

        if (!$question->votes->contains(auth()->user())) {
            $question->votes()->attach(auth()->user()->id);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        if ($question->votes->contains(auth()->user())) {
            $question->votes()->detach(auth()->user()->id);
        }

        return redirect()->back();
    }
}
