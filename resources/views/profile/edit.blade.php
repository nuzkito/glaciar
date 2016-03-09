@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Editar perfil</h1>
    </div>

    @include('partials.errors', ['text' => 'modificar el perfil'])

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    <form action="{{ route('profile.update', $user->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{ $user->id }}">

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
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Editar perfil</button>
            </div>
        </div>
    </form>
</div>
@endsection
