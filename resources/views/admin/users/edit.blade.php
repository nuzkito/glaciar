@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Editar usuario</h1>
        <a href="{{ route('admin.user.index') }}" class="btn btn-default">Volver a la lista de usuarios</a>
    </div>

    @include('partials.errors', ['text' => 'editar el usuario'])

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Nombre" name="name" value="{{ old('name') ?? $user->name }}">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') ?? $user->email }}">
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            </div>
        </div>

        <div class="form-group">
            <label for="role" class="col-sm-2 control-label">Rol</label>
            <div class="col-sm-10">
                <select name="role" class="form-control">
                    <option value="student" @if ((old('role') ?? $user->role) === 'student') selected @endif>Estudiante</option>
                    <option value="teacher" @if ((old('role') ?? $user->role) === 'teacher') selected @endif>Profesor</option>
                    <option value="admin" @if ((old('role') ?? $user->role) === 'admin') selected @endif>Administrador</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Editar usuario</button>
            </div>
        </div>
    </form>
</div>
@endsection
