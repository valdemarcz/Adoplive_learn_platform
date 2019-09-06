@extends('layouts.app')

@section('content')
    <h1>Edit questions</h1>
        {!! Form::open(['action' => ['QuestionsController@update', $question->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('question', 'Question')}}
                {{Form::text('question', $question->question, ['class' => 'form-control', 'placeholder' => 'Question'])}}
            </div>

            <div class="form-group">
                {{Form::label('answerV', 'Answer V')}}
                {{Form::text('answerV', $answerV->answer, ['class' => 'form-control', 'placeholder' => 'Answer V'])}}

                {{Form::label('answerA', 'Answer A')}}
                {{Form::text('answerA', $answerA->answer, ['class' => 'form-control', 'placeholder' => 'Answer A'])}}
                {{Form::label('answerR', 'Answer R')}}
                {{Form::text('answerR', $answerR->answer, ['class' => 'form-control', 'placeholder' => 'Answer R'])}}
                {{Form::label('answerK', 'Answer K')}}
                {{Form::text('answerK', $answerK->answer, ['class' => 'form-control', 'placeholder' => 'Answer K'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
@endsection