<?php



Route::get('/', function () {
    return view('welcome');
});

/**
 *	Khi thay đổi phương thức mặc của resource thì phải vào RouteServicePr.. để custom lại
 *  k thì trong Question $question của phương thức show sẽ k lấy ra được bản ghi tương ứng
 */

// question
Route::resource('/questions', 'QuestionsController')->except('show');
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

// answer
Route::resource('questions.answers', 'AnswerController')->except('index', 'create', 'show');

// best question id
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

// favorite
Route::post('/question/{question}/favorite', 'FavoritesController@store')->name('question.favorite');
Route::delete('/question/{question}/favorite', 'FavoritesController@destroy')->name('question.destroy');
// ------/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
