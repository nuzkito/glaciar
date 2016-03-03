@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="{{ route('course.index') }}" class="btn btn-default">Volver a la lista de cursos</a>
        @can('manage-course-contents', $course)
            <a href="{{ route('content.create', $course->id) }}" class="btn btn-primary">Agregar contenidos</a>
        @endcan
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="{{ route('question.index', $course->id) }}">Preguntas</a></li>
    </ul>

    <ul class="list-group">
        @foreach ($course->contents as $content)
            <li class="list-group-item">
                <a href="{{ route('content.show', $content->id) }}">{{ $content->title }}</a>
                @can('manage-course-contents', $course)
                    <a href="{{ route('content.edit', $content->id) }}" class="btn btn-default btn-xs">Editar</a>
                    <form class="form-button" action="{{ route('content.destroy', $content->id) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>
</div>
@endsection
