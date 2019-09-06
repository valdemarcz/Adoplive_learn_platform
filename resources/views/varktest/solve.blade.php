
@extends('layouts.app')

@section('title', '| Solve Vark Test')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

        <h1>Solve test</h1>
        <hr>

    {{-- Using the Laravel HTML Form Collective to create our form --}}
        {{ Form::open(array('route' => 'varktest.store')) }}

        <div class="form-group">
			@if(count($questions) > 0)
	            @foreach ($questions as $question)
					
					<div class="panel-body">
						<h3>{{ $question->question }}</h3>
						@if(count($answers) > 0)	
							@foreach ($answers as $answer)
								@if($question->id == $answer->q_id)
									{{ Form::checkbox('answers[]', $answer->vark) }}
									{{Form::label('answer', $answer->answer)}}
								</br>
								@endif
								
							@endforeach
						@endif	
					</div>






	            @endforeach
			@else
				<p>No questions found</p>	
			@endif
			<hr>
            {{ Form::submit('Send result', array('class' => 'btn btn-success btn-lg btn-block')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>

@endsection