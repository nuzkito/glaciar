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
        @can('edit-question', $question)
            <a href="/preguntas/{{ $question->id }}/editar" class="btn btn-default">Editar pregunta</a>
        @endcan
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        {!! $question->body !!}
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <hr />
        <h3>Publicar una respuesta</h3>

        <form action="/respuestas" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <div class="form-group">
                <label for="title">Respuesta</label>
                <textarea class="form-control" id="body" name="body" placeholder="Responde a la pregunta">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Responder</button>
            </div>
        </form>

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><strong>No se ha podido enviar la respuesta</strong> por los siguientes motivos:</p>

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
