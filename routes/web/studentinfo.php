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
    Route::get('/student/admission', 'Web\Admin\StudentInformationController@student_admission')->name('student.admission');
    Route::post('/student/admission/add', 'Web\Admin\StudentInformationController@student_admission_add')->name('student.admission.add');
    Route::get('/student/report/{id}', 'Web\Admin\StudentInformationController@student_report')->name('student.report');
    Route::get('/student/view/{id}', 'Web\Admin\StudentInformationController@student_view')->name('student.view');
    Route::get('/student/editadmission/{id}', 'Web\Admin\StudentInformationController@student_editadmission')->name('student.editadmission');
    Route::post('/student/editadmission/edit', 'Web\Admin\StudentInformationController@student_editadmission_edit')->name('student.editadmission.edit');
    Route::get('/student/delete/{id}', 'Web\Admin\StudentInformationController@student_delete')->name('student.delete');
    Route::get('/student/search', 'Web\Admin\StudentInformationController@student_search')->name('student.search');
    Route::get('/student/editsearch/{id}', 'Web\Admin\StudentInformationController@student_editsearch')->name('student.editsearch');
    Route::post('/student/editsearch/edit', 'Web\Admin\StudentInformationController@student_editsearch_edit')->name('student.editsearch.edit');

    Route::get('/bulkdivisionassign', 'Web\Admin\StudentInformationController@bulkdivisionassign')->name('bulkdivisionassign');
    Route::post('/bulkdivisionassign/add', 'Web\Admin\StudentInformationController@bulkdivisionassign_add')->name('bulkdivisionassign.add');

    Route::get('/studentidgenerate', 'Web\Admin\StudentInformationController@studentidgenerate')->name('studentidgenerate');
    Route::get('/student/idgenerate/{id}', 'Web\Admin\StudentInformationController@student_idgenerate')->name('student.idgenerate');
    Route::get('/studentidgenerate/bulk', 'Web\Admin\StudentInformationController@studentidgenerate_bulk')->name('studentidgenerate.bulk');
    Route::post('/studentidgenerate/bulk/post', 'Web\Admin\StudentInformationController@studentidgenerate_bulk_post')->name('studentidgenerate.bulk.post');
    Route::get('/studentid/bulk/print', 'Web\Admin\StudentInformationController@studentid_bulk_print')->name('studentid.bulk.print');
});
