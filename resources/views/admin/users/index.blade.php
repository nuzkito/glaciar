@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Administrar usuarios</h1>
        <a href="/admin/usuarios/nuevo" class="btn btn-primary">Crear nuevo usuario</a>
    </div>

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
                            <a href="#" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger">Eliminar</a>
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
