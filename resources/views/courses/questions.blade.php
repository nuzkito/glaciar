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
</div>
@endsection
