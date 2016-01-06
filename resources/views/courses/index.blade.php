@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="page-header">
        <h1>Cursos</h1>
    </div>

    <div class="list-group">
        @foreach ($courses as $course)
            <a href="/cursos/{{ $course->id }}" class="list-group-item">{{ $course->name }}</a>
        @endforeach
    </div>
</div>
@endsection
