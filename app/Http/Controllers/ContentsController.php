<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Content;

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
}
