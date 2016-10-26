<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

// guest
Route::get('/', 'AttendController@index');
Route::get('/attend/{id}', 'AttendController@Attend');

// admin
Route::get('/admin', 'AdminController@dashboard');
Route::get('/admin/attend', 'AdminController@addAttend');
Route::get('/admin/view/{id}', 'AdminController@viewAttend');
Route::get('/admin/view', 'AdminController@ListAttend');

// admin api
Route::post('/admin/attend/add', 'AdminController@add');
Route::post('/admin/available', 'AdminController@available');
//Route::post('/attend/check', 'AttendController@register');
Route::post('/attend/check2', 'AttendController@register2');
Route::get('/get/attend/{id}', 'AttendController@getAttend');
Route::get('/get/attend/order/{id}', 'AttendController@getAttendOrderStudentID');
Route::get('/get/attend/count/{id}', 'AttendController@getAttendCount');


