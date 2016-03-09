@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $question->course->name }}</h1>
        <a href="{{ route('question.show', $question->id) }}" class="btn btn-default">Volver a la pregunta</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('course.show', $question->course->id) }}">Contenido</a></li>
        <li role="presentation" class="active"><a href="#">Preguntas</a></li>
    </ul>

    <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <h1>Editar pregunta</h1>
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        @include('partials.errors', ['text' => 'editar la pregunta'])

        @if (Session::has('success'))
            <p class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>{{ Session::get('success') }}</strong>
            </p>
        @endif

        <form action="{{ route('question.update', $question->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" name="id" value="{{ $question->id }}">
            <input type="hidden" name="course_id" value="{{ $question->course->id }}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="¿Cuál es tu pregunta?" value="{{ old('title', $question->title) }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" id="body" name="body" placeholder="Amplía tu pregunta si lo necesitas">{{ old('body', $question->body) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Editar pregunta</button>
        </form>
    </div>
</div>
@endsection
