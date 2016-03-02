@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Crear nuevo curso</h1>
        <a href="/admin/cursos" class="btn btn-default">Volver a la lista de cursos</a>
    </div>

    @include('partials.errors', ['text' => 'crear el curso'])

    <form action="/admin/cursos" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nombre" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Usuarios con acceso al curso</label>
            <div class="col-sm-10">
                <select class="form-control" name="users[]" multiple size="15">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Crear curso</button>
            </div>
        </div>
    </form>
</div>
@endsection
