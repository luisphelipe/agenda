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

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('schedules', 'ScheduleController');
    Route::get('/schedules/{schedule}/archive', 'ScheduleController@archive');

    Route::resource('reminders', 'ReminderController');
    Route::resource('services', 'ServiceController');
    Route::resource('clients', 'ClientController');
});
