<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;
use App\Varktestresults;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;


class VarktestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Questions::all();
        $answers = Answers::all();
        return view('varktest.solve')->with('questions', $questions)->with('answers', $answers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'answers' => 'required',
        ]);
        $questions = Questions::all();
        $answers = $request->input('answers');
        $stylecounts = ["V" => 0, "A" => 0, "R" => 0, "K" => 0];
        foreach( $answers as $answer){
            foreach($stylecounts as $x => $x_value){
                if($x == $answer)
                    $stylecounts[$x]+=1;
            }
        }

        $Varktestresults = new Varktestresults;
        $Varktestresults -> V_res = $stylecounts['V'];
        $Varktestresults -> A_res = $stylecounts['A'];
        $Varktestresults -> R_res = $stylecounts['R'];
        $Varktestresults -> K_res = $stylecounts['K'];
        $Varktestresults -> user_id = Auth::user()->id;
        //$Varktestresults ->style = '';
       // $foundmax = 0;
        foreach ($stylecounts as $x => $x_value) {
            
            if($x_value == max($Varktestresults ->V_res,  $Varktestresults->A_res,  $Varktestresults->R_res,  $Varktestresults->K_res))
                $Varktestresults->style = $x;

        }
        $user = Auth::user();
        $user->varkstyle = $Varktestresults->style;
        $user-> save();
        $Varktestresults -> save();


        return redirect('/profile')->with('success', 'Style is known');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
