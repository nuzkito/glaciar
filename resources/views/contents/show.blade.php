@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $content->course->name }}</h1>
        <a href="/cursos/{{ $content->course->id }}" class="btn btn-default">Volver a los contenidos</a>
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
