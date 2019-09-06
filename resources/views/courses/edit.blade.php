@extends('layouts.app')

@section('content')
    <h1>Edit Course</h1>
        {!! Form::open(['action' => ['CoursesController@update', $course->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('coursetitle', 'Course Title')}}
                {{Form::text('coursetitle', $course->Course_title, ['class' => 'form-control', 'placeholder' => 'Course Title'])}}

                {{Form::label('coursecat', 'Course Category')}}
                
               <p>Now your course category is <b> {{$course->Theme}}</b> if you want to set some new which dont exists write here or choose from existing</p>
                <input list="coursecat" name="coursecat" class="form-control"  placeholder="Course Category" >

                <datalist id="coursecat">
                @if(count($categories)>0)
                @foreach($categories as $category)
                    <option value="{{$category->Theme}}">
                
        
                @endforeach
                @endif
                </datalist>
            </div>
           
                {{Form::label('coursedesc', 'Course Description')}}
                {{ Form::textarea('coursedesc', $course->description, array('class' => 'form-control', 'id'=>'article-ckeditor')) }}

            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        
@endsection