@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="/cursos" class="btn btn-default">Volver a la lista de cursos</a>
        @can('manage-course-contents', $course)
            <a href="/cursos/{{ $course->id }}/crear-contenido" class="btn btn-primary">Agregar contenidos</a>
        @endcan
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="/cursos/{{ $course->id }}/preguntas">Preguntas</a></li>
    </ul>

    <ul class="list-group">
        @foreach ($course->contents as $content)
            <li class="list-group-item">
                <a href="/contenidos/{{ $content->id }}">{{ $content->title }}</a>
                @can('manage-course-contents', $course)
                    <a href="/contenidos/{{ $content->id }}/editar" class="btn btn-default btn-xs">Editar</a>
                @endcan
            </li>
        @endforeach
    </ul>
</div>
@endsection
