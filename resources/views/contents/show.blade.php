@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $content->course->name }}</h1>
        <a href="/cursos/{{ $content->course->id }}" class="btn btn-default">Volver a los contenidos</a>
        <a href="/contenidos/{{ $content->id }}/editar" class="btn btn-default">Editar</a>
        <form class="form-button" action="/contenidos/{{ $content->id }}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="/cursos/{{ $content->course->id }}/preguntas">Preguntas</a></li>
    </ul>

    <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
      <h1>{{ $content->title }}</h1>
    </div>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        {!! $content->parsedBody !!}
    </div>
</div>
@endsection
