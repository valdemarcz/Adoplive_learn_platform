@extends('layouts.app')

@section('content')

	<h1>Quizes</h1>
	@if(count($quizestf)>0)
		@foreach($quizestf as $quizf)
			<div class="well">
				<h3><a href="#">{{$quizf}}</a></h3>
				
			</div>
		@endforeach
	@else
		<p> No lessons found</p>
	@endif

@endsection