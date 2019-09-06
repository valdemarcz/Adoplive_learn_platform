@extends('layouts.app')

@section('content')
	<h1>Create Course</h1>
		{!! Form::open(['action' => 'CoursesController@store', 'method' => 'POST']) !!}
			<div class="form-group">
				{{Form::label('coursetitle', 'Course Title')}}
				{{Form::text('coursetitle', '', ['class' => 'form-control', 'placeholder' => 'Course Title'])}}
				{{Form::label('coursecat', 'Course Category')}}
				
				{{Form::label('coursestyle', 'Number of quizes after which should check style')}}
				{{Form::text('coursestyle', '', ['class' => 'form-control', 'placeholder' => 'Number of quizes solved'])}}
				{{Form::label('coursecat', 'Course Category')}}
				
				
				<input list="coursecat" name="coursecat" class="form-control" placeholder="Course Category">
  				<datalist id="coursecat">
  				@if(count($categories)>0)
    			@foreach($categories as $category)
					<option value="{{$category->Theme}}">
		
    			@endforeach
    			@endif
  				</datalist>
				
				{{Form::label('coursedesc', 'Course Description')}}
				{{ Form::textarea('coursedesc', null, array('class' => 'form-control', 'id'=>'article-ckeditor')) }}
			</div>

			{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{!! Form::close() !!}
@endsection