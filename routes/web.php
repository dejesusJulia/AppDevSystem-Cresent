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

################################
#### USER ACCESSIBLE ROUTES ####
################################
Route::middleware('user')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');

    // TO COMPLETE PROFILE
    Route::get('/complete-profile', 'HomeController@edit')->name('complete.edit');
    Route::post('/complete-profile', 'HomeController@update')->name('complete.update');

    // TO EDIT PROFILE
    Route::get('/profile-edit/{user}', 'UserController@edit')->name('profile.edit');
    Route::patch('/profile-edit', 'UserController@update')->name('profile.update');
    
    // TO ACCESS PDF
    Route::get('/profile-view/{pdf}', 'UserController@viewPdf')->name('profile.view');
    Route::get('/profile-download/{pdf}', 'UserController@downloadPdf')->name('profile.download');

    // TO EDIT SUBJECT OF INTEREST/FIELD OF EXPERTISE
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::delete('/category/destroy/{category}', 'CategoryController@destroy')->name('category.destroy');

    // TO CONNECT WITH OTHER USERS
    Route::get('/users/show/{user}', 'UserController@show')->name('users.show');
    Route::post('/connection/store', 'ConnectionController@store')->name('connection.store');
    Route::put('/connection/accept-request/{connection}', 'ConnectionController@acceptRequest')->name('connection.acceptrequest');
    Route::put('/connection/decline-request/{connection}', 'ConnectionController@declineRequest')->name('connection.declinerequest');
    Route::delete('/connection/destroy/{connection}', 'ConnectionController@destroy')->name('connection.destroy');

    // TO SEARCH/FILTER RESULTS
    Route::get('/search/users', 'HomeController@searchResults')->name('search.searchresults');
    Route::get('/search-by/position/{positionId}', 'HomeController@selectByPosition')->name('position.search');
    Route::get('/search-by/subject/{subjectId}', 'HomeController@selectBySubject')->name('subject.search');
    Route::get('/search-by/no-fields', 'HomeController@selectNullCateg')->name('home.nosubject');
    Route::post('/search-by/position-and-subject', 'HomeController@selectByPS')->name('search.both');

    // ADD TEAM
    Route::get('/team/create', 'TeamController@create')->name('team.create');
    Route::post('/team/create', 'TeamController@store')->name('team.store');
    Route::get('/team/edit/', 'TeamController@edit')->name('team.edit');
    Route::patch('/team/edit/{team}', 'TeamController@update')->name('team.update');
    Route::put('/team/add/sent/{member}', 'TeamController@addMemberSent')->name('team.addmembersent');
    Route::put('/team/add/received/{member}', 'TeamController@addMemberReceived')->name('team.addmemberreceived');

});

#################################
#### ADMIN ACCESSIBLE ROUTES ####
#################################
Route::middleware('admin')->group(function(){
    Route::get('/dash', 'HomeController@dash')->name('dash');

    Route::get('/positions', 'PositionController@index')->name('position.index');
    Route::post('/positions/store', 'PositionController@store')->name('position.store');

    Route::patch('/positions/edit/{position}', 'PositionController@update')->name('position.update');
    Route::delete('/positions/delete/{position}')->name('position.destroy');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::delete('/users/delete/{user}', 'UserController@destroy')->name('users.destroy');

    Route::get('/subjects', 'SubjectController@index')->name('subject.index');
    Route::post('/subjects', 'SubjectController@store')->name('subject.store');
    Route::patch('/subjects/update/{subject}', 'SubjectController@update')->name('subject.update');
    Route::delete('/subjects/delete/{subject}', 'SubjectController@destroy')->name('subject.destroy');

});


