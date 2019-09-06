@extends('layouts.app')
@section('content')


    <div class="">
    
    </div>
    <div class="styles_table">

    <h1>Your style is: {{$style}}</h1>
    <h1> Your result of Visual: {{  round($varkres->V_res*100/$sum)}} %</h1>
    <h1> Your result of Aural: {{ round($varkres->A_res*100/$sum)}} %</h1>
    <h1> Your result of Read/Write: {{  round($varkres->R_res*100/$sum)}} %</h1>
    <h1> Your result of Kinesthetic: {{  round($varkres->K_res*100/$sum)}} %</h1>
    </div>
    </br>
    

</div>

@endsection