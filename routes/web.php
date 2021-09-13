<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});




Route::group(['prefix'=>'admin','as'=>'admin.','namespace' => 'App\\Http\\Controllers\\Admin'], function(){
    Route::get('/',  'DashboardController@index');
    Route::post('/exams/save-exam-questions', 'ExamsController@save_exam_questions');
    Route::get('/exams/get-exam-questions/{exam}', 'ExamsController@get_exam_questions');
    Route::post('/exams/{exam}/save-answers', 'ExamsController@save_exam_answers')->name('exams.save_exam_answers');

    Route::resource('/exams', 'ExamsController');
});





