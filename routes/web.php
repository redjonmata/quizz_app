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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/create-test', 'TestController@showTests');
Route::post('/create-test', 'TestController@createTests');
Route::get('/review-tests', 'TestController@reviewTests');
Route::get('/tests/{testId}/questions', 'TestController@showTest');
Route::get('/tests/{testId}/questions/delete', 'TestController@deleteTest');
Route::post('/tests/{testId}/questions', 'TestController@addQuestions');

