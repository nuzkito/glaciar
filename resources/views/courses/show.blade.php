@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="/cursos" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="/cursos/{{ $course->id }}/questions">Preguntas</a></li>
    </ul>

    <ul class="list-group">
        @foreach ($course->contents as $content)
            <a href="/contenidos/{{ $content->id }}" class="list-group-item">{{ $content->title }}</a>
        @endforeach
    </ul>
</div>
@endsection
