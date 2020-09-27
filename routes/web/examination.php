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

    Route::get('/promotestudents', 'Web\Admin\ExaminationController@promotestudents')->name('promotestudents');
    Route::post('/promotestudents/add', 'Web\Admin\ExaminationController@promotestudents_add')->name('promotestudents.add');
    Route::get('/demotestudents', 'Web\Admin\ExaminationController@demotestudents')->name('demotestudents');
    Route::post('/demotestudents/add', 'Web\Admin\ExaminationController@demotestudents_add')->name('demotestudents.add');

    Route::get('/exam', 'Web\Admin\ExaminationController@exam')->name('exam');
    Route::post('/exam', 'Web\Admin\ExaminationController@exam_post')->name('exam');
    Route::get('/addexam', 'Web\Admin\ExaminationController@addexam')->name('addexam');
    Route::post('/addexam', 'Web\Admin\ExaminationController@addexam_post')->name('addexam');
    Route::post('/exam/create', 'Web\Admin\ExaminationController@exam_create')->name('exam.create');
    Route::get('/exam/evaluation', 'Web\Admin\ExaminationController@exam_evaluation')->name('exam.evaluation');
    Route::post('/examevaluation/submit', 'Web\Admin\ExaminationController@examevaluation_submit')->name('examevaluation.submit');

    Route::get('/terminatestudentlist', 'Web\Admin\ExaminationController@terminatestudentlist')->name('terminatestudentlist');
    Route::get('/studentterminate', 'Web\Admin\ExaminationController@student_terminate')->name('student.terminate');
    Route::post('/studentterminate/submit', 'Web\Admin\ExaminationController@student_terminate_submit')->name('student.terminate.submit');
    Route::post('/studentterminate/approve', 'Web\Admin\ExaminationController@student_terminate_approve')->name('student.terminate.approve');
    Route::get('/studentterminate/reject/{id}', 'Web\Admin\ExaminationController@student_terminate_reject')->name('student.terminate.reject');

});
