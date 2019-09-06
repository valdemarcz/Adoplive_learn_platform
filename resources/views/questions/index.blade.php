@extends('layouts.app')

@section('content')
	<h1>Questions</h1>
	@if(count($questions)>0)
		@foreach($questions as $question)
			<div class="well">
				<h3><a href="/questions/{{$question->id}}">{{$question->question}}</a></h3>
				<small>Written on {{$question->created_at}}</small>
			</div>
		@endforeach
		{{$questions->links()}}
	@else
		<p>No questions found</p>
	@endif			

	<a href="/questions/create" class="btn btn-success">Add new question</a>	
@endsection