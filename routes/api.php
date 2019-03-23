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
if ($request->isMethod('options')) {
    return response()->json([
        'success' => true,
        'message' => 'method is option'
    ], 204);
}
//create report
Route::post('reports/create', 'ApiController@createReport');

//advocates, translators, reporters 
Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

 
Route::group(['middleware' => 'auth.jwt'], function () {
    //all users
    Route::get('user', 'UserController@getAuthUser');
    Route::post('user', 'UserController@updateUser');
    Route::get('logout', 'UserController@logout');

    //role = reporter, advocate
    Route::get('reports/{id}', 'ReportController@getReport');
    Route::post('reports/{id}', 'ReportController@updateReport');

    //role = advocate
    Route::get('reports', 'ReportController@getAllReports');
    Route::get('reports/{country}/{state}', 'ReportController@getReportsByLocation');    
    Route::post('report/accept', 'UserController@acceptReport');
    Route::post('report/drop', 'UserController@dropReport');
    Route::post('report/takeOver', 'UserController@reportRequestTakeOver');
    Route::post('report/handOver', 'UserController@reportHandOver');
    Route::get('reports/active', 'UserController@activeReports');

    //role = advocate
    Route::post('activities/create', 'ActivityController@create');
    Route::get('activities/{id}', 'ActivityController@get');
    
});
