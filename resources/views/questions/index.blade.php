@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="{{ route('course.index') }}" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('course.show', $course->id) }}">Contenido</a></li>
        <li role="presentation" class="active"><a href="{{ route('question.index', $course->id) }}">Preguntas</a></li>
    </ul>

    <form action="{{ route('question.store') }}" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <h2>Nueva pregunta</h2>
        <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="¿Cuál es tu pregunta?" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="body" name="body" placeholder="Amplía tu pregunta si lo necesitas">{{ old('body') }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Preguntar</button>
        </div>
    </form>

    @include('partials.errors', ['text' => 'enviar la pregunta'])

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    @foreach ($questions as $question)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><a href="{{ route('question.show', $question->id) }}">{{ $question->title }}</a></h3>
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
