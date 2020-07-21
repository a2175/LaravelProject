<?php
use App\Post;
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
})->name('home');

Route::prefix('post')->group(function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('show/{id}', 'PostController@show')->name('post.show');
    Route::get('create', 'PostController@create')->name('post.create');
    Route::post('create', 'PostController@store')->name('post.store');
    Route::get('edit/{id}', 'PostController@edit')->name('post.edit');
    Route::patch('edit/{id}', 'PostController@update')->name('post.update');
    Route::get('destroy/{id}', 'PostController@destroy')->name('post.destroy');
    Route::delete('destroy/{id}', 'PostController@delete')->name('post.delete');
});

Route::prefix('comment')->group(function () {
    Route::get('{postId}', 'CommentController@index')->name('comment.index');
    Route::post('create/{postId}', 'CommentController@store')->name('comment.store');
    Route::delete('destroy/{id}', 'CommentController@delete')->name('comment.delete');
});
