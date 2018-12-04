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

Route::get('/', 'PostsController@index');
Route::get('/login', 'PagesController@login');
Route::get('/register', 'PagesController@register');

Route::redirect('/index', '/');

Auth::routes();

Route::get('/profile', 'ProfileController@index');

Route::get('/update_profile', 'ProfileController@edit');
Route::put('/update_profile', 'ProfileController@update')->name('user_update');

Route::resource('posts', 'PostsController');
Route::get('/dashboard', 'DashboardController@index');