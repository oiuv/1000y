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


Route::get('/', 'PagesController@root')->name('root');

// Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

// 针对客户端的固定链接
Route::get('download.html', 'PagesController@download')->name('download');
Route::get('account.html', 'PagesController@account')->name('account');

// 游戏数据库
Route::get('sdb/{name}', 'SdbController@index')->name('sdb.index');
Route::get('sdb/{name}/{id}', 'SdbController@show')->name('sdb.show');
