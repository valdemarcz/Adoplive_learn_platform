@extends('layouts.app')
@section('content')


    <div class="">
    
    </div>
    <div class="styles_table">

   
    </br>
    <h1 class="center">Your subscriptions </h1>
	<div class="courses">
    @if(count($courses)>0)
		@foreach($courses as $course)
			<div class="course_block">
				<h3 class="center"><a href="/coursesolution/{{$course->id}}">{{$course->Course_title}}</a></h3>
				<h3 class="left_top">{{ $course->Theme }}</h3>
				<p><b>Description:</b> {!! $course->description !!}</p>
				<small><b>Written on </b> {{$course->created_at}}</small>
				</br>
				<small><b>updated at </b> {{$course->updated_at}}</small>
				
			</div>
		@endforeach
		{{$courses->links()}}
	@else
		<p> No courses found</p>
	@endif

</div>

@endsection