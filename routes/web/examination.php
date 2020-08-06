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
    Route::get('/examination', 'Web\Admin\ExaminationController@examination')->name('examination');
    Route::post('/examination', 'Web\Admin\ExaminationController@examination_post')->name('examination.post');
    Route::get('/examinationmark', 'Web\Admin\ExaminationController@examinationmark')->name('examinationmark');
    Route::post('/examinationmark/submit', 'Web\Admin\ExaminationController@examinationmark_submit')->name('examinationmark.submit');
});
