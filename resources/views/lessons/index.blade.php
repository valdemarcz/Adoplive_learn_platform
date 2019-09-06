@extends('layouts.app')

@section('content')

	<h1>Lessons</h1>
	@if(count($lessons)>0)
		@foreach($lessons as $lesson)
			<div class="well">
				<h3><a href="/lessons/{{$lesson->id}}">{{$lesson->lesson_title}}</a></h3>
				<small>Written on {{$lesson->created_at}}</small><br>
				<small>Lesson learning style {{$lesson->learning_style}}</small><br>
				@foreach($courses as $course)
					@if($course->id == $lesson->Course_id)
						<small>{{ $course->Course_title }}</small>
					@endif
				@endforeach
			</div>
		@endforeach
	@else
		<p> No lessons found</p>
	@endif

@endsection