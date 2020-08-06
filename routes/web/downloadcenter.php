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
    Route::get('/contentupload', 'Web\Admin\DownloadCenterController@contentupload')->name('contentupload');
    Route::post('/contentupload/add', 'Web\Admin\DownloadCenterController@contentupload_add')->name('contentupload.add');
    Route::get('/contentupload/edit/{id}', 'Web\Admin\DownloadCenterController@contentupload_edit')->name('contentupload.edit');
    Route::post('/contentupload/editcontent', 'Web\Admin\DownloadCenterController@contentupload_editcontent')->name('contentupload.editcontent');
    Route::get('/contentupload/delete/{id}', 'Web\Admin\DownloadCenterController@contentupload_delete')->name('contentupload.delete');

    Route::get('/assignments', 'Web\Admin\DownloadCenterController@assignments')->name('assignments');
    Route::get('/addassignment', 'Web\Admin\DownloadCenterController@addassignment')->name('addassignment');
    Route::get('/studymaterial', 'Web\Admin\DownloadCenterController@studymaterial')->name('studymaterial');
    Route::get('/addstudymaterial', 'Web\Admin\DownloadCenterController@addstudymaterial')->name('addstudymaterial');
    Route::get('/syllabus', 'Web\Admin\DownloadCenterController@syllabus')->name('syllabus');
    Route::get('/addsyllabus', 'Web\Admin\DownloadCenterController@addsyllabus')->name('addsyllabus');
});
