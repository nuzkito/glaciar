<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;

class AnswerVotesController extends Controller
{
    public function store($id)
    {
        $answer = Answer::findOrFail($id);

        if (!$answer->votes->contains(auth()->user())) {
            $answer->votes()->attach(auth()->user()->id);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $answer = Answer::findOrFail($id);

        if ($answer->votes->contains(auth()->user())) {
            $answer->votes()->detach(auth()->user()->id);
        }

        return redirect()->back();
    }
}
