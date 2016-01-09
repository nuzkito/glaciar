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

    <form action="/preguntas" method="POST">
        {!! csrf_field() !!}
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <div class="form-group">
            <label for="title">Nueva pregunta</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="¿Cuál es tu pregunta?" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="body" name="body" placeholder="Amplía tu pregunta si lo necesitas">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Preguntar</button>
    </form>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><strong>No se ha podido enviar la pregunta</strong> por los siguientes motivos:</p>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    @foreach ($questions as $question)
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
