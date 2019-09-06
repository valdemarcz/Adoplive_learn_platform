@extends('layouts.app')

@section('content')
	<h1>Create Lesson</h1>
		{!! Form::open(['action' => 'LessonsController@store', 'method' => 'POST', 'files'=>true ]) !!}
			<div class="form-group">
				{{Form::label('lessontitle', 'Lesson Title')}}
				{{Form::text('lessontitle', '', ['class' => 'form-control', 'placeholder' => 'Lesson Title'])}}
				
				@if(!request()->route('id'))

				<b>This Lesson should be for:</b>
				
				<select name='Course_lesson'>
  				@foreach($courses as $course)
  				<option value="{{$course->id}}">{{$course->Course_title}}</option>
  				@endforeach
				</select>
				@else
				{{ Form::hidden('Course_lesson', request()->route('id')) }}
				@endif


				<p>Add this lesson for style:</p>
				{{ Form::checkbox('V', 1, null, ['class' => 'field']) }}
				{{Form::label('V', 'Visual')}}
				{{ Form::checkbox('A', 1, null, ['class' => 'field']) }}
				{{Form::label('A', 'Aural')}}
				{{ Form::checkbox('R', 1, null, ['class' => 'field']) }}
				{{Form::label('R', 'Read/Write')}}
				{{ Form::checkbox('K', 1, null, ['class' => 'field']) }}
				{{Form::label('K', 'Kinesthetic')}}
				

				</br>
				{{Form::label('content', 'Lesson Content')}}
				{{ Form::textarea('content', null, array('class' => 'form-control', 'id'=>'article-ckeditor')) }}
			</div>
				{!! Form::file('file_name[]',['multiple']) !!}
			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection