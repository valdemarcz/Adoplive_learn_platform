<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use DB;


class AllCoursesController extends Controller
{
	
    public function ShowCourses(){

    	$courses = Course::orderBy('Theme')->paginate(10);

    	$categories = Course::distinct()->get(['Theme']);
    	return view('allcourses.show')->with('courses', $courses)->with('categories', $categories);
    	}



    public function ShowCategory($category){
    	
    		$courses = Course::where('Theme', '=', $category)->paginate(10
            );
    		$categories = Course::distinct()->get(['Theme']);
    	
    	return view('allcourses.show')->with('courses', $courses)->with('category', $category)->with('categories', $categories);

    }	
}
