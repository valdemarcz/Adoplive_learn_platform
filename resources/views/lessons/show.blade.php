@extends('layouts.app')

@section('content')
	
	<div class="container">
	
		@foreach($courses as $course)
			@if($course->id == $lesson->Course_id)
				<h1>Lesson from {{$course->Course_title}} and style is {{ $lesson->learning_style }}</h1>
			@endif
		@endforeach
		<h3 class="lead">{{ $lesson->lesson_title }}</h3>
		<hr>
		<p class="lead">{!! $lesson->Content !!} </p>
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
    	<hr>
	<a href="/lessons/createquiz/{{$lesson->id}}" class="btn btn-primary">Add new quiz</a>
<a href="/lessons/{{$lesson->id}}/edit" class="btn btn-primary">Edit</a>
	</div>	

@endsection