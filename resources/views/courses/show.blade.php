@extends('layouts.app')

@section('content')
<a href="/questions" class="btn btn-primary">Go Back</a>
	<h1>{{$course->Course_title}}</h1>
	@if(count($lessons)>0)
		@foreach($lessons as $lesson)
			<div class="well">
				<h3><a href="/lessons/{{$lesson->id}}">{{$lesson->lesson_title}}</a></h3>
				<small>Learning style {{$lesson->learning_style}}</small>
				<br>
				<small>Written on {{$lesson->created_at}}</small>
			</div>
		@endforeach
	@else
		<p> No lessons found</p>
	@endif
<a href="/courses/createlesson/{{$course->id}}" class="btn btn-primary">Add new lesson</a>
<a href="/courses/{{$course->id}}/edit" class="btn btn-primary">Edit</a>

	{!!Form::open(['action' => ['CoursesController@destroy', $course->id], 'method'=>'POST', 'class' => 'pull-right'])!!}
		{{Form::hidden('_method', 'DELETE')}}
		{{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
	{!!Form::close()!!}
@endsection