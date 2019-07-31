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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::middleware(['jwt'])->group(function () {
     Route::get('/gradebooks', 'GradebookController@index');
     Route::get('/professors', 'ProfessorController@index');
     Route::post('/gradebooks/create', 'GradebookController@store');
     Route::post('/professors/create', 'ProfessorController@store');
     Route::get('/professors/onlyUnsignedProfessors', 'ProfessorController@onlyUnsignedProfessors');
     Route::get('/gradebooks/professors/{id}', 'GradebookController@show');     
     Route::get('/professors/{id}', 'ProfessorController@show');
//     Route::get('/cars/{id}', 'CarController@show');
//     Route::post('/cars', 'CarController@store');
//     Route::put('/cars/{id}', 'CarController@update');
//     Route::get('/delete/{id}', 'CarController@destroy');    
 });
Route::get('/');
Route::post('/login', 'Auth\LoginController@authenticate');  
Route::post('/register', 'Auth\RegisterController@register');  
//Route::get('/register', 'Auth\RegisterController@create');
//Route::resource('cars', 'CarController');