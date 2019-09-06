@extends('layouts.app')

@section('content')
<a href="/questions" class="btn btn-default">Go Back</a>
	<h1>{{$question->question}}</h1>
	<p>
	@if(count($answers) > 0)
		@foreach($answers as $answer)
			{{$answer->answer}}
			{{$answer->vark}}
		</br>
		@endforeach
	@else
		<p>No answers found</p>		
	@endif			
	</p>
	<hr>
	<a href="/questions/{{$question->id}}/edit" class="btn btn-default">Edit</a>

	{!!Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method'=>'POST', 'class' => 'pull-right'])!!}
		{{Form::hidden('_method', 'DELETE')}}
		{{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
	{!!Form::close()!!}
@endsection