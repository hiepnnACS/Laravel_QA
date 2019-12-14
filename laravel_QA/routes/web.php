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
    return view('welcome');
});

/**
 *	Khi thay đổi phương thức mặc của resource thì phải vào RouteServicePr.. để custom lại
 *  k thì trong Question $question của phương thức show sẽ k lấy ra được bản ghi tương ứng
 */

Route::resource('/questions', 'QuestionsController')->except('show');
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
