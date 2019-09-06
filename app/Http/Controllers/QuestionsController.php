<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Answers;
use DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    public function index()
    {
        //$questions = Questions::all();
        $questions = Questions::orderBy('question')->paginate(10);
        return view('questions.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
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
            'question' => 'required',
            'answerV' => 'required',
            'answerA' => 'required',
            'answerR' => 'required',
            'answerK' => 'required'
        ]);

        $question = new Questions;
        $question->question = $request->input('question');
        $question->save();
        $LastInsertId = $question->id;
        $answerV = new Answers;
        $answerA = new Answers;
        $answerR = new Answers;
        $answerK = new Answers;

        $answerV -> answer = $request->input('answerV');
        $answerV -> vark = 'V';
        $answerV -> q_id = $LastInsertId;

        $answerA -> answer = $request->input('answerA');
        $answerA -> vark = 'A';
        $answerA -> q_id = $LastInsertId;

        $answerR -> answer = $request->input('answerR');
        $answerR -> vark = 'R';
        $answerR -> q_id = $LastInsertId;

        $answerK -> answer = $request->input('answerK');
        $answerK -> vark = 'K';
        $answerK -> q_id = $LastInsertId;

        $answerV->save();
        $answerA->save();
        $answerR->save();
        $answerK->save();

        return redirect('/questions')->with('success', 'Question created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Questions::find($id);
        $answers = DB::table('answers')->where('q_id', $id)->get();
        return view('questions.show')->with('question', $question)->with('answers', $answers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Questions::find($id);
        $answerV = DB::table('answers')->where([['q_id', $id],['vark','V']])->first();
        $answerA = DB::table('answers')->where([['q_id', $id],['vark','A']])->first();
        $answerR = DB::table('answers')->where([['q_id', $id],['vark','R']])->first();
        $answerK = DB::table('answers')->where([['q_id', $id],['vark','K']])->first();
         return view('questions.edit')->with('question', $question)->with('answerV', $answerV)->with('answerA', $answerA)->with('answerR', $answerR)->with('answerK', $answerK);
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
        $this->validate($request, [
            'question' => 'required',
            'answerV' => 'required',
            'answerA' => 'required',
            'answerR' => 'required',
            'answerK' => 'required'
        ]);

        $question = Questions::find($id);
        $question->question = $request->input('question');
        $question->save();
        
        $answerVid = DB::table('answers')->where([['q_id', $id],['vark','V']])->first();
        $answerAid = DB::table('answers')->where([['q_id', $id],['vark','A']])->first();
        $answerRid = DB::table('answers')->where([['q_id', $id],['vark','R']])->first();
        $answerKid = DB::table('answers')->where([['q_id', $id],['vark','K']])->first();

        $answerV = Answers::find($answerVid->id);
        $answerA = Answers::find($answerAid->id);
        $answerR = Answers::find($answerRid->id);
        $answerK = Answers::find($answerKid->id);

        $answerV -> answer = $request->input('answerV');
        $answerV -> vark = 'V';
        
        $answerA -> answer = $request->input('answerA');
        $answerA -> vark = 'A';

        $answerR -> answer = $request->input('answerR');
        $answerR -> vark = 'R';

        $answerK -> answer = $request->input('answerK');
        $answerK -> vark = 'K';

        $answerV->save();
        $answerA->save();
        $answerR->save();
        $answerK->save();

        return redirect('/questions')->with('success', 'Question updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Questions::find($id);
        $question->delete();
        $answerVid = DB::table('answers')->where([['q_id', $id],['vark','V']])->first();
        $answerAid = DB::table('answers')->where([['q_id', $id],['vark','A']])->first();
        $answerRid = DB::table('answers')->where([['q_id', $id],['vark','R']])->first();
        $answerKid = DB::table('answers')->where([['q_id', $id],['vark','K']])->first();

        if($answerVid){
        $answerV = Answers::find($answerVid->id);
        $answerA = Answers::find($answerAid->id);
        $answerR = Answers::find($answerRid->id);
        $answerK = Answers::find($answerKid->id);
        $answerV->delete();
        $answerA->delete();
        $answerR->delete();
        $answerK->delete();
    }
        return redirect('/questions')->with('success', 'Question removed');
    }
}
