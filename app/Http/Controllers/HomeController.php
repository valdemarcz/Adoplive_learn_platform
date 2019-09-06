<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Varktestresults;
use DB;
use App\Course;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function subscribtionss(){
        $user = auth()->user();
        $courses = DB::table('subscriptions')
        ->join('courses', 'courses.id', '=', 'subscriptions.course_id')
        ->where('subscriptions.user_id', '=', $user->id)->paginate(10);
        return view('user.subs')->with('user', $user)->with('courses', $courses);

    }

    public function quizeshow(Request $request){
        $counter=0;
        $quizes=DB::table('quizes')->where('lesson_id', '=', $request->input('lesson_id'))->get();
        $course_id = $request->course_id;
        return view('quizes.solve')->with('quizes', $quizes)->with('counter', $counter)->with('course_id', $course_id);
    }
    
    public function showmarks(){
        $user = auth()->user();
        $counter=0;
        $countermax=0;
        $marks = DB::table('quizesanswers')
        ->join('lessons', 'lessons.id', '=', 'quizesanswers.lesson_id')
        ->join('courses', 'courses.id', '=', 'lessons.course_id')
        ->where('quizesanswers.user_id', '=', $user->id)->get();

        return view('user.marks')->with('marks', $marks)->with('counter', $counter)->with('countermax', $countermax);
    }



    public function showVarkres(){

    	$user = auth()->user();
        $courses = DB::table('subscriptions')
        ->join('courses', 'courses.id', '=', 'subscriptions.course_id')
        ->where('subscriptions.user_id', '=', $user->id)->paginate(10);

        if($user){
    	$varkres = DB::table('varktestresults')->where('user_id', $user->id)->orderBy('id', 'desc')->first();
    	
    	switch ($user->varkstyle) {
    		case 'V':
    			$style='Visual';
    			break;
    		case 'A':
    			$style='Aural';
    			break;
    		case 'R':
    			$style='Read/write';
    			break;
    		case 'K':
    			$style='Kinesthetic';	
        	}
    	}

    	$sum = 0;
    	$sum = $varkres->A_res + $varkres->V_res + $varkres->R_res + $varkres->K_res;
    	return view('user.profile')->with('user', $user)->with('varkres', $varkres)->with('sum', $sum)->with('style', $style)->with('courses', $courses);
    }

    public function course($id){
       $course = Course::find($id);
       $lessons = Lesson::distinct()->select('lesson_title')->where('Course_id', $id)->get();
       return view('coursedetails.coursedetails')->with('course', $course)->with('lessons', $lessons)->with('courseid', $id);
    }

    public function solvecourse($id, $lesid=null){
        $user = auth()->user();
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
        return view('user.solvecourse')->with('course', $course)->with('lessons', $lessons)->with('lesson1', $lesson1)->with('lessonsother', $lessonsother)->with('quizes', $quizes)->with('files', $files);
    }

}
