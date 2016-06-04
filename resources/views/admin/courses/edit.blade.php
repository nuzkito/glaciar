@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Editar curso</h1>
        <a href="{{ route('admin.course.index') }}" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    @include('partials.errors', ['text' => 'editar el curso'])

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    <form action="{{ route('admin.course.update', $course->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{ $course->id }}">

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nombre" name="name" value="{{ old('name') ?? $course->name }}">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Estudiantes del curso</label>
            <div class="col-sm-10">
                <select class="form-control" name="users[]" multiple size="15">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($course->users->contains($user)) selected @endif>
                            {{ $user->name }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Profesores del curso</label>
            <div class="col-sm-10">
                <select class="form-control" name="teachers[]" multiple size="15">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if ($course->teachers->contains($user)) selected @endif>
                            {{ $user->name }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Editar curso</button>
            </div>
        </div>
    </form>
</div>
@endsection
