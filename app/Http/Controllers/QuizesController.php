<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Course;
use App\Lesson;
use Illuminate\Support\Facades\Auth;
class QuizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function storeresult(Request $request){
        $numofquestions = $request->counter;
        $correct = 0;
        $SumOfPoints = 0;
        $MaxPossibleSum = 0;
        $user = auth()->user();
        for($i = 1; $i<=$numofquestions; $i++){
        $answersget[$i] = 'answ'.$i;
        $answerscorrect[$i] = 'answer'.$i; 
         }
        for($i = 1; $i<=$numofquestions; $i++){
            $asg = $answersget[$i];
            $asc = $answerscorrect[$i];
            $coransw = $request->$asc;
            $ans = $request->$asg;
            if($coransw == $ans)
               $correct++;
        }

        //return $correct;
        //$as = $answersget[1];
        //return $request->$as;

       // SELECT * FROM `quizesanswers` join lessons ON quizesanswers.lesson_id=lessons.id join courses on lessons.Course_id=courses.id where quizesanswers.user_id=2 and courses.id=1 

        DB::table('quizesanswers')->insert(
                ['lesson_id' => $request->lesson_id, 'max_score' => $numofquestions,'result' => $correct, 'user_id' => $user->id ]
                );

        $course = DB::table('courses')->where('courses.id', '=', $request->course_id)->get();

        $allsolutions = DB::table('quizesanswers')
        ->join('lessons', 'quizesanswers.lesson_id', '=', 'lessons.id')
        ->join('courses', 'lessons.Course_id', '=', 'courses.id')->where([
            ['quizesanswers.user_id', '=', $user->id],
            ['courses.id', '=', $request->course_id],
        ])->get();
        if (count($allsolutions) >= $course[0]->NLessonsToCheck) {
        foreach ($allsolutions as $solution) {
            $SumOfPoints = $SumOfPoints + $solution->result;
            $MaxPossibleSum = $MaxPossibleSum + $solution->max_score;
        }
            if($SumOfPoints<$MaxPossibleSum/2){
                $Varktestres=DB::table('varktestresults')->where('user_id', '=', $user->id)->first();
                $changedfrom = DB::table('changes')->where('user_id', '=', $user->id)->get();
                $individualresults['V'] = $Varktestres->V_res;
                $individualresults['A'] = $Varktestres->A_res;
                $individualresults['R'] = $Varktestres->R_res;
                $individualresults['K'] = $Varktestres->K_res;
                if(count($changedfrom)>0){
                    foreach ($individualresults as $key => $value) {
                       foreach ($changedfrom as $changedfrom1) {
                            if ($key == $changedfrom1->varkstyle or $key == $user->varkstyle) {
                                unset($individualresults[$key]);    
                            }
                       }
                    }

                }
                $StyleToSave = 'A';
                $ValueToCheck = 0;
                    foreach ($individualresults as $key => $value) {
                        
                        if($value>=$ValueToCheck){
                            $ValueToCheck = $value;
                            $StyleToSave = $key;
                        } 
                    }
                     DB::table('changes')->insert(
                     ['user_id' => $user->id, 'varkstyle' => $user->varkstyle,]
                );
                    DB::table('users')
                    ->where('id', $user->id)
                    ->update(['varkstyle' => $StyleToSave]);
                   


            }

            $lesid = $request->lesson_id;
            $id = $request->course_id;
            $lesson1 = Lesson::find($lesid);
            $course = Course::find($id);
            $lessons = DB::table('lessons')->where([
            ['Course_id','=', $id],
            ['learning_style', '=', $user->varkstyle ],
            ])->get();
            $lessonsother = DB::table('lessons')->where([
            ['Course_id','=', $id],
            ['learning_style', '<>', $user->varkstyle ],
            ])->get();
            $quizes=DB::table('quizes')->where('lesson_id', '=', $lesid)->get();
             $files= DB::table('files')->where('lesson_id', $lesid)->get();
            return view('user.solvecourse')->with('course', $course)->with('lessons', $lessons)->with('lesson1', $lesson1)->with('lessonsother', $lessonsother)->with('quizes', $quizes)->with('success', 'Quiz solved')->with('files', $files);
        

       // return redirect()->route('coursesolution', ['id' => $request->lesson_id])
           // ->with('success', 'Quiz solved and style changed');
    }
        
        //$user = auth()->user();
        $lesid = $request->lesson_id;
        $id = $request->course_id;
        $lesson1 = Lesson::find($lesid);
        $course = Course::find($id);
        $lessons = DB::table('lessons')->where([
            ['Course_id','=', $id],
            ['learning_style', '=', $user->varkstyle ],
        ])->get();
        $lessonsother = DB::table('lessons')->where([
            ['Course_id','=', $id],
            ['learning_style', '<>', $user->varkstyle ],
        ])->get();
        $quizes=DB::table('quizes')->where('lesson_id', '=', $lesid)->get();
         $files= DB::table('files')->where('lesson_id', $lesid)->get();
       // Session::put('url.intended', URL::full());
        return view('user.solvecourse')->with('course', $course)->with('lessons', $lessons)->with('lesson1', $lesson1)->with('lessonsother', $lessonsother)->with('quizes', $quizes)->with('success', 'Quiz solved')->with('files', $files);

        //return redirect()->route('coursesolution', ['id' =>$request, 'lesid' => $request->lessid])
           // ->with('success', 'Quiz solved');
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'question'=>'required|max:100',
            'answ' =>'required',
            
            ]);

         DB::table('quizes')->insert(
                ['question' => $request->question, 'lesson_id' => $request->lesson_id,'answer' => $request->answ]
                );
         return redirect()->route('lessons.show', ['id' => $request->lesson_id])
            ->with('success', 'Quiz created');
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
