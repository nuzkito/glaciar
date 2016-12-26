@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    @if ($coursesAsTeacher->count())
        <div class="page-header">
            <h1>Cursos en los que eres profesor</h1>
        </div>
        <div class="list-group">
            @foreach ($coursesAsTeacher as $course)
                <a href="{{ route('course.show', $course->id) }}" class="list-group-item">{{ $course->name }}</a>
            @endforeach
        </div>
    @endif

    <div class="page-header">
        <h1>Tus Cursos</h1>
    </div>

    <div class="list-group">
        @foreach ($courses as $course)
            <a href="{{ route('course.show', $course->id) }}" class="list-group-item">{{ $course->name }}</a>
        @endforeach
    </div>

</div>
@endsection
