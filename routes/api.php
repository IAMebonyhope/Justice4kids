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
|
*/

//create report
Route::post('reports/create', 'ApiController@createReport');

//advocates, translators, reporters 
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register')->middleware('cors');

 
Route::group(['middleware' => 'auth.jwt'], function () {
    //all users
    Route::get('user', 'UserController@getAuthUser');
    Route::post('user', 'UserController@updateUser');
    Route::get('logout', 'UserController@logout');

    //role = reporter, advocate
    Route::get('reports/{id}', 'ReportController@getReport');
    Route::post('reports/{id}', 'ReportController@updateReport');

    //role = advocate
    Route::get('reports/all', 'ReportController@getAllReports');
    Route::get('reports/{country}/{state}', 'ReportController@getReportsByLocation');    
    Route::post('report/accept', 'ReportController@acceptReport');
    Route::post('report/drop', 'ReportController@dropReport');
    Route::post('report/takeOver', 'ReportController@reportRequestTakeOver');
    Route::post('report/handOver', 'ReportController@reportHandOver');
    Route::get('reports/active', 'ReportController@activeReports');

    //role = advocate
    Route::post('activities/create', 'ActivityController@create');
    Route::get('activities/{id}', 'ActivityController@get');
    
});
