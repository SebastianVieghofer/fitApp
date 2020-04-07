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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth::routes();

//Route::get('/', 'HomeController@index')->name('profile');
Auth::routes(['verify' => true]);

//return views
Route::get('/settings', function () {return view('settings');})->name('settings');
Route::get('/profile', function () {return view('profile');})->name('profile');

//Create

//Read
Route::get('/', 'ReadController@selectRandomWorkout')->middleware('auth')->name('workout');

//Update
Route::post('/updateFitnessLevel', 'UpdateController@updateFitnessLevel')->middleware('auth')->name('updateFitnessLevel');

Route::get('/updateAfterWorkoutCompleted', 'UpdateController@updateAfterWorkoutCompleted')->middleware('auth')->name('updateAfterWorkoutCompleted');

//Delete




// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
