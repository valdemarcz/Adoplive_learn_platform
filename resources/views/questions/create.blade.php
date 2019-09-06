@extends('layouts.app')

@section('content')
	<h1>Create questions</h1>
		{!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{Form::label('question', 'Question')}}
				{{Form::text('question', '', ['class' => 'form-control', 'placeholder' => 'Question'])}}
			</div>

			<div class="form-group">
				{{Form::label('answerV', 'Answer V')}}
				{{Form::text('answerV', '', ['class' => 'form-control', 'placeholder' => 'Answer V'])}}

				{{Form::label('answerA', 'Answer A')}}
				{{Form::text('answerA', '', ['class' => 'form-control', 'placeholder' => 'Answer A'])}}
				{{Form::label('answerR', 'Answer R')}}
				{{Form::text('answerR', '', ['class' => 'form-control', 'placeholder' => 'Answer R'])}}
				{{Form::label('answerK', 'Answer K')}}
				{{Form::text('answerK', '', ['class' => 'form-control', 'placeholder' => 'Answer K'])}}
			</div>
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection