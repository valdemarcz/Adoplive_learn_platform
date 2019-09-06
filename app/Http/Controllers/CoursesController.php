<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use DB;
use Illuminate\Support\Facades\Auth;
class CoursesController extends Controller
{

    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('Admin')){
            $courses = Course::orderBy('updated_at')->paginate(10);
        }
        else{
            $courses = Course::where('user_id', '=', $user->id)->paginate(10
            );
        }
        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createlesson($id = null)
    {
        if(!$id)
            return redirect()->route('lessons.create');
        else
            return view('lessons.create')->with('courseid', $id);
    }




    public function create()
    {
        $categories = Course::distinct()->get(['Theme']);
        return view('courses.create')->with('categories', $categories);
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
            'coursetitle'=>'required|max:100',
            'coursecat' =>'required',
            'coursedesc' =>'required',
            ]);

        $course = new Course;
        $course->Course_title = $request->input('coursetitle');
        $course->Theme = $request->input('coursecat');
        $course->description = $request->input('coursedesc');
        $course->NLessonsToCheck = $request->input('coursestyle');
        $course->user_id = Auth::user()->id;
        
        $course->save();

    //Display a successful message upon save
        return redirect()->route('courses.index')
            ->with('success', 'Course created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $lessons = DB::table('lessons')->where('Course_id', $id)->get();
        return view('courses.show')->with('course', $course)->with('lessons', $lessons);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        //$lessons =  DB::table('lessons')->where('Course_id', $id)->get();
        $categories = Course::distinct()->get(['Theme']);
        $sel="";
         return view('courses.edit')->with('course', $course)->with('categories', $categories)->with('sel', $sel);
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
        $course = Course::find($id);
        $course->Course_title = $request->input('coursetitle');
        if($request->input('coursecat')){
            $course->Theme = $request->input('coursecat');
        }
        $course->description = $request->input('coursedesc');
        
        $course->save();
        return redirect()->route('courses.index')
            ->with('success', 'Course updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        $lessons =  $lessons = DB::table('lessons')->where('Course_id', $id)->get();
        $lessons->delete();
       return redirect()->route('courses.index')
            ->with('success', 'Course deleted');
    }
}
