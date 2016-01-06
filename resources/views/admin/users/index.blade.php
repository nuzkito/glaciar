@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Administrar usuarios</h1>
        <a href="/admin/usuarios/nuevo" class="btn btn-primary">Crear nuevo usuario</a>
    </div>

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="/admin/usuarios/{{ $user->id }}/edit" class="btn btn-primary">Editar</a>
                            <form class="form-button" action="/admin/usuarios/{{ $user->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
    <div class="row text-center">
        {!! $users->links() !!}
    </div>
</div>
@endsection
