@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="/cursos" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="/cursos/{{ $course->id }}">Contenido</a></li>
        <li role="presentation" class="active"><a href="#">Preguntas</a></li>
    </ul>

    @foreach ($course->questions as $question)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="/preguntas/{{ $question->id }}">{{ $question->title }}</a></h3>
            </div>
            <div class="panel-body">
                {{ $question->body }}
            </div>
            <div class="panel-footer">
                {{ $question->created_at }} |
                {{ $question->user->name }} |
                {{ $question->answers->count() }} respuestas
            </div>
        </div>
    @endforeach

    {{ $questions->links() }}
</div>
@endsection
