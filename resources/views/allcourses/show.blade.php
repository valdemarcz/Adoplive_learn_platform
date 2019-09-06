@extends('layouts.app')
@section('content')
<div class="content_courses">
<div class="themes">
<h3>Categories</h3>
</br>
@if(count($categories)>0)
<ul>

	@foreach($categories as $category)
	<li><a href="../allcourses/{{$category->Theme}}">{{ $category->Theme }}</a></li>	
	@endforeach
</ul>
@endif
</div>
</br>
<div class="courses">
	<h3>Courses</h3>
    @if(count($courses)>0)
		@foreach($courses as $course)
			<div class="course_block">
				<h3 class="center"><a href="/coursedetails/{{$course->id}}">{{$course->Course_title}}</a></h3>
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
</div>
@endsection