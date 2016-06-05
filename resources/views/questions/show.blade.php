@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $question->course->name }}</h1>
        <a href="{{ route('question.index', $question->course->id) }}" class="btn btn-default">Volver a las preguntas</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ route('course.index', $question->course->id) }}">Contenido</a></li>
        <li role="presentation" class="active"><a href="#">Preguntas</a></li>
    </ul>

    <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <h1>{{ $question->title }}</h1>
        @can('edit-question', $question)
            <a href="{{ route('question.edit', [$question->id]) }}" class="btn btn-default">Editar pregunta</a>
        @endcan
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        {!! $question->body !!}
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <hr />
        <h3>Publicar una respuesta</h3>

        <form action="{{ route('answer.store') }}" method="POST">
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

        @include('partials.errors', ['text' => 'enviar la respuesta'])

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
                    @if (isset($answerToEdit) && $answerToEdit->id === $answer->id)
                        <form action="{{ route('answer.update', $answerToEdit->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" value="{{ $answerToEdit->id }}">
                            <div class="form-group">
                                <label for="title">Respuesta</label>
                                <textarea class="form-control" id="body" name="body" placeholder="Responde a la pregunta">{{ old('body', $answerToEdit->body) }}</textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Editar respuesta</button>
                            </div>
                        </form>
                    @else
                        {{ $answer->body }}
                    @endif
                </div>
                <div class="panel-footer">
                    {{ $answer->created_at->diffForHumans() }} |
                    {{ $answer->votes->count() }} voto{{$answer->votes->count() === 1 ? '' : 's' }} |
                    @if ($answer->votes->contains(auth()->user()))
                        <form class="form-link" action="{{ route('answer.unvote', $answer->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn-link">Eliminar voto</button>
                        </form>
                    @else
                        <form class="form-link" action="{{ route('answer.vote', $answer->id) }}" method="post">
                            {{ csrf_field() }}
                            <button class="btn-link">Votar</button>
                        </form>
                    @endif
                    @can('edit-answer', $answer)
                        <a href="{{ route('answer.edit', $answer->id) }}">Editar</a>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
