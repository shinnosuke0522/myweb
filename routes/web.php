<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SendEmailController;

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

Route::get('/', 'PostsController@index');
Route::get('/login', 'PagesController@login');
Route::get('/register', 'PagesController@register');

Route::redirect('/index', '/');

Auth::routes();

// Profile
Route::get('/profile', 'ProfileController@index');
Route::get('/update_profile', 'ProfileController@edit');
Route::put('/update_profile', 'ProfileController@update_profile')->name('user_update_profile');

//Post
Route::resource('posts', 'PostsController');
Route::get('/dashboard', 'DashboardController@index');

//User PDF
Route::get('/userpdf', 'DashboardController@pdf');

//User
Route::get('/users', 'UserController@index');
Route::get('users/excel-export', 'UserController@export');
Route::get('/users/{id}', 'UserController@show');

//Email
Route::get('email', 'SendEmailController@writeEmail');
Route::post('email/send', 'SendEmailController@sendEmail');

//Favorite
Route::get('favorite-list','FavoriteController@index');
Route::post('posts/{post_id}/favorite', 'FavoriteController@store');
Route::delete('posts/{post_id}/favorite', 'FavoriteController@destroy');

//Comments
Route::post('posts/{post_id}/comment', 'CommentsController@store');
Route::delete('comment/{post_id}', 'CommentsController@destroy');