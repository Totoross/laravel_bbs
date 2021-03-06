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

Route::get('/', 'TopicsController@index')->name('root');

//Laravel 自带了用户认证功能 php artisan make:auth； 生成路由  Auth::routes() 及 auth 文件夹视图
//  Auth::routes() 等同于一下 路由

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

//用户资源路由
Route::resource('users', 'UserController', ['only' => ['show', 'update', 'edit'] ]);
//话题路由
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
//Route::get('topics/{topics}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
//话题分类路由
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
//图片上传
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
//话题回复和删除
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
//消息通知
Route::get('notifications', 'UserController@notifications')->name('notifications.index');
//后台访问拒绝
Route::get('permission-denied', 'UserController@permissionDenied')->name('permission-denied');