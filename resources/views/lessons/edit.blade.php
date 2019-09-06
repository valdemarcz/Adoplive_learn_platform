@extends('layouts.app')

@section('content')
    <h1>Edit {{ $lesson->lesson_title }} Lesson</h1>
        {!! Form::open(['action' => ['LessonsController@update', $lesson->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('lessontitle', 'Lesson Title')}}
                {{Form::text('lessontitle', $lesson->lesson_title, ['class' => 'form-control', 'placeholder' => 'Course Title'])}}

            </div>
				{{Form::label('lessonbody', 'Lesson body')}}
                {{ Form::textarea('lessonbody', $lesson->Content, array('class' => 'form-control', 'id'=>'article-ckeditor')) }}


            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        
@endsection