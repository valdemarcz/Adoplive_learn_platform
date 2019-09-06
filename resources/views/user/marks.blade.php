@extends('layouts.app')
@section('content')



    <div class="styles_table">
    @if(count($marks)>0)
	@foreach($marks as $mark)
	<p>{{$mark->result}} of {{$mark->max_score}} in {{$mark->lesson_title }} from {{ $mark->Course_title }}</p>
	@php
  		$counter = $counter + $mark->result;
  		$countermax = $countermax + $mark->max_score;
	@endphp
	@endforeach
	<h2>Your score from all lessons is {{$counter}} MAX possible is {{$countermax}}</h2>
	@else
		<h1>Sorry, you don't have marks yet</h1>
	@endif
    </div>
   
@endsection