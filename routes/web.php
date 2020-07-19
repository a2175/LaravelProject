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

Route::get('post', 'PostController@index')->name('post.index');
Route::get('post/show/{id}', 'PostController@show')->name('post.show');
Route::get('post/create', 'PostController@create')->name('post.create');
Route::post('post/create', 'PostController@store')->name('post.store');
Route::get('post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::patch('post/edit/{id}', 'PostController@update')->name('post.update');
Route::get('post/destroy/{id}', 'PostController@destroy')->name('post.destroy');
Route::delete('post/destroy/{id}', 'PostController@delete')->name('post.delete');

Route::get('comment/{postId}', 'CommentController@index')->name('comment.index');
Route::post('comment/create/{postId}', 'CommentController@store')->name('comment.store');
Route::delete('comment/destroy/{id}', 'CommentController@delete')->name('comment.delete');