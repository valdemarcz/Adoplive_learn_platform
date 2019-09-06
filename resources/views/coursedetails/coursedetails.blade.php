@extends('layouts.app')

@section('content')

	<h1>{{$course->Course_title}}</h1>

	<b>{!!$course->description!!}</b>
	Lessons of this course:
	@if(count($lessons)>0)
		@foreach($lessons as $lesson)
			<div class="well">
			<ul>
				<li>{{$lesson->lesson_title}}</li>
			</ul>
			</div>
		@endforeach
	@else
		<p> No lessons found</p>
	@endif
	{!! Form::open(['action' => 'SubscriptionsController@store', 'method' => 'POST']) !!}
	{{ Form::hidden('course_id', $course->id) }}
@if(Auth::check())



{{Form::submit('Subscribe for this course', ['class' => 'btn btn-primary'])}}
@endif
{!! Form::close() !!}

@endsection