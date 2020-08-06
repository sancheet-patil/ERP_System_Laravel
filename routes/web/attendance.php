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

Route::group(['middleware' => ['auth','disablemoveback']], function() {
    Route::get('/classattendance', 'Web\Admin\AttendanceController@classattendance')->name('classattendance');
    Route::get('/getclassattendancereport', 'Web\Admin\AttendanceController@getclassattendancereport')->name('getclassattendancereport');
    Route::get('/getclassattendance', 'Web\Admin\AttendanceController@getclassattendance')->name('getclassattendance');
    Route::post('/classattendance/submit', 'Web\Admin\AttendanceController@classattendance_submit')->name('classattendance.submit');

    Route::get('/staffattendance', 'Web\Admin\AttendanceController@staffattendance')->name('staffattendance');
    Route::get('/getstaffattendance', 'Web\Admin\AttendanceController@getstaffattendance')->name('getstaffattendance');
    Route::post('/staffattendance/submit', 'Web\Admin\AttendanceController@staffattendance_submit')->name('staffattendance.submit');
});
