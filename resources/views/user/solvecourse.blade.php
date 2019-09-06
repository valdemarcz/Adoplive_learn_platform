@extends('layouts.app')

@section('content')


<div class="content_courses">
<div class="themes">
@if(count($lessons)>0)
<h3>Lessons recommended for you</h3>
</br>

<ul>

	@foreach($lessons as $lesson)
	<li><a href="../../coursesolution/{{$course->id}}/{{$lesson->id}}">{{ $lesson->lesson_title }}</a></li>	
	@endforeach
</ul>
@else
<h3>Here is no lessons recommended for you, sorry</h3>
@endif
<!--
<h3>Other lessons</h3>
</br>
@if(count($lessonsother)>0)
<ul>

	@foreach($lessonsother as $lesson)
	<li><a href="../../coursesolution/{{$course->id}}/{{$lesson->id}}">{{ $lesson->lesson_title }}, {{$lesson->learning_style}}</a></li>	
	@endforeach
</ul>
@endif
-->
</div>
</br>


@if($lesson1)
	<div class="container courses">
	
		
		<h1 class="center">Lesson from {{$course->Course_title}} and style is {{ $lesson1->learning_style }}</h1>
			
		<h3 class="lead center" >{{ $lesson1->lesson_title }}</h3>
		<hr>
		<p class="lead">{!! $lesson1->Content !!} </p>
    	<hr>
		@if(count($files)>0)
			@foreach($files as $file)
				@if($file->file_format == 'pdf' )

					<iframe src="{{asset('storage/upload/' .$file->file_name) }}" width="100%" height="800"></iframe>


				@endif
				@if($file->file_format == 'PNG' || $file->file_format == 'jpg' || $file->file_format == 'BMP'|| $file->file_format == 'GIF' || $file->file_format == 'TIFF' || $file->file_format == 'SVG')


					
					<img src="{{ asset('storage/upload/' .$file->file_name) }}" width="1140" height="800" />

				@endif
				@if($file->file_format == 'mp4' )

					<video height="400px" controls>
						<source src="{{asset('storage/upload/' .$file->file_name) }}" type="video/mp4"/>
					</video>
				@endif
				@if($file->file_format == 'mp3' )

					<audio class="col-md-6" controls>
						<source src="{{asset('storage/upload/' .$file->file_name) }}" type="audio/mp3"/>
					</audio>
				@endif
			@endforeach

		@endif
		
		{!! Form::open(['action' => 'HomeController@quizeshow', 'method' => 'POST']) !!}


		{{ Form::hidden('lesson_id', request()->route('lesid')) }}
		{{ Form::hidden('course_id', request()->route('id')) }}

		@if(count($quizes)>0)
		{{Form::submit('Solve quiz for this course', ['class' => 'btn btn-primary'])}}
		@endif
		{!! Form::close() !!}
	</div>	
@endif	

</div>
@endsection