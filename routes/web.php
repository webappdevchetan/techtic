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

Route::get('/','HomeController@welcome');
Route::get('/blog/detail/{slug}', 'BlogController@detail')->name('blog.detail');
Auth::routes();



Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/blog/add', 'BlogController@create')->name('blog.create');
   
    Route::post('/blog/store', 'BlogController@store')->name('blog.store');
    Route::post('/blog/comment', 'BlogController@storeComment')->name('blog.comment.store');
    Route::delete('/comment/delete/{id}', 'BlogController@deleteComment')->name('blog.comment.delete');

});
