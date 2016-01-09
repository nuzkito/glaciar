@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>{{ $course->name }}</h1>
        <a href="/cursos/{{ $course->id }}" class="btn btn-default">Volver a los contenidos</a>
    </div>

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Contenido</a></li>
        <li role="presentation"><a href="/cursos/{{ $course->id }}/preguntas">Preguntas</a></li>
    </ul>

    <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
        <h2>Crear nuevo contenido</h2>

        <form action="/contenidos" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="body">Contenido</label>
                <textarea class="form-control" id="body" name="body">{{ old('body') }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publicar contenido</button>
            </div>
        </form>

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><strong>No se ha podido crear el contenido</strong> por los siguientes motivos:</p>

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
</div>
@endsection
