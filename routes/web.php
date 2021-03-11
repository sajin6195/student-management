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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add-student', 'HomeController@addStudent')->name('add-student');
Route::get('/edit-student', 'HomeController@editStudent')->name('edit-student');
Route::post('/update-student', 'HomeController@updateStudent')->name('update-student');
Route::get('/delete-student', 'HomeController@deleteStudent')->name('delete-student');
Route::get('/add-marks', 'HomeController@addMarks')->name('add-marks');
Route::post('/store-marks', 'HomeController@storeMarks')->name('store-marks');
Route::get('/edit-marks', 'HomeController@editMarks')->name('edit-marks');
Route::post('/update-marks', 'HomeController@updateMarks')->name('update-marks');
Route::get('/delete-marks', 'HomeController@deleteMarks')->name('delete-marks');
