@extends('layouts.app')

@section('content')
	<h1>Solve Quiz</h1>
		{!! Form::open(['action' => 'QuizesController@storeresult', 'method' => 'POST']) !!}
		@if(count($quizes)>0)
		@foreach($quizes as $quiz)
			<div class="form-group">
				<h3>{{$quiz->question}}</h3>
				@php
  				 $counter++;
				@endphp
				{{ Form::hidden('quiz_id'.$counter, $quiz->id) }}
				{{ Form::hidden('answer'.$counter, $quiz->answer) }}
				{{ Form::hidden('lesson_id', $quiz->lesson_id) }}
				{{$quiz->answer}}
				</br>
				{{Form::label('answ'.$counter, 'Answer')}}
				{{Form::select('answ'.$counter, array('1' => 'True', '0' => 'False'))}}
				
			</div>
		@endforeach
			{{ Form::hidden('counter', $counter) }}
			{{ Form::hidden('course_id', $course_id) }}
			{{$course_id}}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
			{!! Form::close() !!}
		@else
			<p>No quizes for this lesson</p>
		@endif	

			
@endsection