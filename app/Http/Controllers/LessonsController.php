<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use App\Course;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonsController extends Controller
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
        $lessons = Lesson::all();
        $courses = Course::all();
        return view('lessons.index')->with('lessons', $lessons)->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user=Auth::user();
        if($user->hasRole('Admin')){
            $courses = Course::orderBy('updated_at')->paginate(10);
        }
        else{
            $courses = Course::where('user_id', '=', $user->id)->paginate(10
            );
        } 

        return view('lessons.create')->with('courses', $courses);
    }

    public function createquiz($id)
    {

        return view('quizes.create')->with('lessonid', $id);
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
            'lessontitle'=>'required|max:100',
            'Course_lesson' =>'required',
            'content' =>'required',
            ]);

             for($i = 0;$i < count($request->file('file_name'));$i++)
        {

             $file = $request->file('file_name')[$i];
             $destination_path = '../storage';
             $extension = $file->getClientOriginalExtension();
             $files = $file->getClientOriginalName();
             $fileName = $files.'.'.$extension;
             //return $files;
             $file->storeAs('upload', $files);
             //storeAs('public/upload', $files);
             //move('public/upload',$fileName);
             //storeAs('public/upload', $files);
             //Storage::put('files', $files);
             //Storage::setVisibility($files, 'public');

        }
            
            if ($request->V) {
                $lessonv = new Lesson();
                $lessonv->lesson_title = $request->lessontitle;
                $lessonv->Course_id = $request->Course_lesson;
                $lessonv->learning_style = 'V';
                $lessonv->Content = $request->content;
                $lessonv->save();
                $insID = $lessonv->id;

                for($i = 0;$i < count($request->file('file_name'));$i++)
        {

             $file = $request->file('file_name')[$i];
             $destination_path = public_path().'/files';
             $extension = $file->getClientOriginalExtension();
             $files = $file->getClientOriginalName();
             $fileName = $files.'.'.$extension;
             DB::table('files')->insert(['lesson_id' => $insID, 'file_name' => $files, 'file_format' => $extension]);

        }
               // DB::table('lessons')->insert(
               // ['lesson_title' => $request->lessontitle, 'Course_id' => $request->Course_lesson,'Content' => $request->content, 'learning_style'=>'V']
               // );


            }
            if ($request->A) {
              // DB::table('lessons')->insert(
               // ['lesson_title' => $request->lessontitle, 'Course_id' => $request->Course_lesson,'Content' => $request->content, 'learning_style'=>'A']
               // );
                $lessona = new Lesson();
               $lessona->lesson_title = $request->lessontitle;
                $lessona->Course_id = $request->Course_lesson;
                $lessona->learning_style = 'V';
                $lessona->Content = $request->content;
                $lessona->save();
                 $insID = $lessona->id;
                 for($i = 0;$i < count($request->file('file_name'));$i++)
        {

             $file = $request->file('file_name')[$i];
             $destination_path = public_path().'/files';
             $extension = $file->getClientOriginalExtension();
             $files = $file->getClientOriginalName();
             $fileName = $files.'.'.$extension;
             DB::table('files')->insert(['lesson_id' => $insID, 'file_name' => $files, 'file_format' => $extension]);

        }
            }
            if ($request->R) {
              // DB::table('lessons')->insert(
               // ['lesson_title' => $request->lessontitle, 'Course_id' => $request->Course_lesson,'Content' => $request->content, 'learning_style'=>'R']
               // );
                $lessonr = new Lesson();
               $lessonr->lesson_title = $request->lessontitle;
                $lessonr->Course_id = $request->Course_lesson;
                $lessonr->learning_style = 'V';
                $lessonr->Content = $request->content;
                $lessonr->save();
                 $insID = $lessonr->id;
                 for($i = 0;$i < count($request->file('file_name'));$i++)
        {

             $file = $request->file('file_name')[$i];
             $destination_path = public_path().'/files';
             $extension = $file->getClientOriginalExtension();
             $files = $file->getClientOriginalName();
             $fileName = $files.'.'.$extension;

             DB::table('files')->insert(['lesson_id' => $insID, 'file_name' => $files, 'file_format' => $extension]);

        }
            }
            if ($request->K) {
             //  DB::table('lessons')->insert(
                //['lesson_title' => $request->lessontitle, 'Course_id' => $request->Course_lesson,'Content' => $request->content, 'learning_style'=>'K']
               // );
                $lessonk = new Lesson();
               $lessonk->lesson_title = $request->lessontitle;
                $lessonk->Course_id = $request->Course_lesson;
                $lessonk->learning_style = 'V';
                $lessonk->Content = $request->content;
                $lessonk->save();
                 $insID = $lessonk->id;
                 for($i = 0;$i < count($request->file('file_name'));$i++)
        {

             $file = $request->file('file_name')[$i];
             $destination_path = public_path().'/files';
             $extension = $file->getClientOriginalExtension();
             $files = $file->getClientOriginalName();
             $fileName = $files.'.'.$extension;
             DB::table('files')->insert(['lesson_id' => $insID, 'file_name' => $files, 'file_format' => $extension]);

        }

            }
        

    //Display a successful message upon save
        return redirect()->route('courses.show', ['id' => $request->Course_lesson])
            ->with('success', 'Lesson created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses =  Course::all();
        $lesson = Lesson::find($id);
        //$url = Storage::get('2.PNG');
        $files= DB::table('files')->where('lesson_id', $id)->get();
        return view('lessons.show')->with('lesson', $lesson)->with('courses', $courses)->with('files', $files);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::find($id);

        return view('lessons.edit')->with('lesson', $lesson);
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
        $lesson = Lesson::find($id);
        $lesson->lesson_title = $request->lessontitle;
        $lesson->Content = $request->lessonbody;
        $lesson->save();
        return redirect()->route('lessons.show', $id)
            ->with('success', 'Lesson updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson-> Lesson::find($id);
        $lessontitle->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Lesson deleted');
    }
}
