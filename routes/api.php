<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/users/all/query/{name}', 'ApiController@searchByName');
Route::get('/users/subjects/query/{subjectId}/{name}', 'ApiController@searchBySubject');
Route::get('/users/positions/query/{positionId}/{name}', 'ApiController@searchByPosition');
Route::get('/users/subjects-and-positions/query/{subjectId}/{positionId}/{name}', 'ApiController@searchByPS');
Route::get('/users/subjects/null/{name}', 'ApiController@searchByNullCateg');
Route::get('/count-of-users-per-position', 'ApiController@positionUserCount');
Route::get('/count-of-users-per-subject', 'ApiController@subjectUserCount');
Route::get('/count-of-registered-users', 'ApiController@registeredUsersCount');
Route::get('/count-of-team-members', 'ApiController@teamMembersCount');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
