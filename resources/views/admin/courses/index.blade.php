@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Administrar cursos</h1>
        <a href="{{ route('admin.course.create') }}" class="btn btn-primary">Crear nuevo curso</a>
    </div>

    @if (Session::has('success'))
        <p class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('success') }}</strong>
        </p>
    @endif

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>
                            <a href="{{ route('admin.course.edit', $course->id) }}" class="btn btn-primary">Editar</a>
                            <form class="form-button" action="{{ route('admin.course.destroy', $course->id) }}" method="POST">
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
        {!! $courses->links() !!}
    </div>
</div>
@endsection
