@extends('layouts.app')

@section('content')
	<h1>Create Quiz</h1>
		{!! Form::open(['action' => 'QuizesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{Form::label('question', 'Question')}}
				{{Form::text('question', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
				
				
				{{ Form::hidden('lesson_id', request()->route('id')) }}
				</br>
				{{Form::label('answ', 'Answer')}}
				{{Form::select('answ', array('1' => 'True', '0' => 'False'))}}
				
			</div>

			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection