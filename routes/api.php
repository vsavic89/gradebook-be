<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

 Route::middleware(['jwt'])->group(function () {
     Route::get('/gradebooks', 'GradebookController@index');
     Route::get('/professors', 'ProfessorController@index');
     Route::post('/gradebooks/create', 'GradebookController@store');
     Route::post('/professors/create', 'ProfessorController@store');
     Route::post('/students', 'StudentController@store');
     Route::post('/comments', 'CommentController@store');
     Route::delete('/gradebooks/{id}', 'GradebookController@destroy');
     Route::delete('/comments/{id}', 'CommentController@destroy');     
     Route::get('/comments/{id}', 'CommentController@show');
     Route::put('/students/{id}', 'StudentController@update');
     Route::get('/students/{id}', 'StudentController@show');
     Route::delete('/students/{id}', 'StudentController@destroy');     
     Route::get('/gradebooks/{id}', 'GradebookController@show');     
     Route::get('/professors/{id}', 'ProfessorController@show');    
 });
Route::get('/');
Route::post('/login', 'Auth\LoginController@authenticate');  
Route::post('/register', 'Auth\RegisterController@register');  