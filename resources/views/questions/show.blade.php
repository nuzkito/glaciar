@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $question->course->name }}</h1>
        <a href="/cursos/{{ $question->course->id }}/preguntas" class="btn btn-default">Volver a las preguntas</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="/cursos/{{ $question->course->id }}">Contenido</a></li>
        <li role="presentation" class="active"><a href="#">Preguntas</a></li>
    </ul>

    <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <h1>{{ $question->title }}</h1>
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        {!! $question->body !!}
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        @foreach ($question->answers as $answer)
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $answer->user->name }}
                </div>
                <div class="panel-body">
                    {{ $answer->body }}
                </div>
                <div class="panel-footer">
                    {{ $answer->created_at }}
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
