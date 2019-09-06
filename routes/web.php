<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	
    return redirect('allcourses');
})->middleware('varktest');

Auth::routes();



Route::get('/profile', 'HomeController@showVarkres')->name('home')->middleware('varktest');

Route::get('/subscribtions', 'HomeController@subscribtionss');

Route::get('/coursedetails/{id}', 'HomeController@course');


Route::post('storesolution', 'QuizesController@storeresult');

Route::get('marks', 'HomeController@showmarks');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('questions', 'QuestionsController');

Route::get('courses/createlesson/{id?}', 'CoursesController@createlesson');

Route::get('lessons/createquiz/{id}', 'LessonsController@createquiz');

Route::resource('courses', 'CoursesController');

Route::resource('lessons', 'LessonsController');

//Route::resource('/createlesson/{id?}', 'LessonsController@Createlesson');

Route::resource('/varktest', 'VarktestController')->only([
    'create', 'store'
]);

Route::resource('quizes', 'QuizesController');

Route::get('profile/{id?}', 'HomeController@showVarkres');

Route::get('allcourses', 'AllCoursesController@ShowCourses');

Route::get('coursesolution/{id}/{lesid?}', 'HomeController@solvecourse');

Route::post('coursesolution', 'HomeController@quizeshow');

Route::get('allcourses/{category}', 'AllCoursesController@ShowCategory');


Route::resource('subscriptions', 'SubscriptionsController');