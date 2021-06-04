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

Route::middleware('user')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/complete-profile', 'HomeController@edit')->name('complete.edit');
    Route::post('/complete-profile', 'HomeController@update')->name('complete.update');
});

Route::middleware('admin')->group(function(){
    Route::get('/dash', 'HomeController@dash')->name('dash');

    Route::get('/positions', 'PositionController@index')->name('position.index');
    Route::post('/positions/store', 'PositionController@store')->name('position.store');
    // Route::get('/positions/edit/{position}', 'PositionController@edit')->name('position.edit');
    Route::patch('/positions/edit/{position}', 'PositionController@update')->name('position.update');
    Route::delete('/positions/delete/{position}')->name('position.destroy');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::delete('/users/delete/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('/subjects', 'SubjectController@index')->name('subject.index');
    Route::post('/subjects', 'SubjectController@store')->name('subject.store');
    Route::patch('/subjects/update/{subject}', 'SubjectController@update')->name('subject.update');
    Route::delete('/subjects/delete/{subject}', 'SubjectController@destroy')->name('subject.destroy');

});


