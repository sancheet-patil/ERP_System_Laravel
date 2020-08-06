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
    Route::get('/bonafide', 'Web\Admin\CertificatesController@bonafide')->name('bonafide');
    Route::post('/bonafide/issue', 'Web\Admin\CertificatesController@bonafide_issue')->name('bonafide.issue');
    Route::post('/bonafide/issue/print', 'Web\Admin\CertificatesController@bonafide_issue_print')->name('bonafide.issue.print');
    Route::get('/bonafide/view/{id}', 'Web\Admin\CertificatesController@bonafide_view')->name('bonafide.view');
    Route::get('/bonafide/delete/{id}', 'Web\Admin\CertificatesController@bonafide_delete')->name('bonafide.delete');
    Route::get('/bonafide/print/{id}', 'Web\Admin\CertificatesController@bonafide_print')->name('bonafide.print');

    Route::get('/leavingcertificate', 'Web\Admin\CertificatesController@leavingcertificate')->name('leavingcertificate');
    Route::post('/leavingcertificate/issue', 'Web\Admin\CertificatesController@leavingcertificate_issue')->name('leavingcertificate.issue');
    Route::post('/leavingcertificate/issue/print', 'Web\Admin\CertificatesController@leavingcertificate_issue_print')->name('leavingcertificate.issue.print');
    Route::get('/leavingcertificate/view/{id}', 'Web\Admin\CertificatesController@leavingcertificate_view')->name('leavingcertificate.view');
    Route::get('/leavingcertificate/edit/{id}', 'Web\Admin\CertificatesController@leavingcertificate_edit')->name('leavingcertificate.edit');
    Route::post('/leavingcertificate/editlc', 'Web\Admin\CertificatesController@leavingcertificate_editlc')->name('leavingcertificate.editlc');
    Route::get('/leavingcertificate/delete/{id}', 'Web\Admin\CertificatesController@leavingcertificate_delete')->name('leavingcertificate.delete');
    Route::get('/leavingcertificate/print/{id}', 'Web\Admin\CertificatesController@leavingcertificate_print')->name('leavingcertificate.print');

    Route::get('/form17lc', 'Web\Admin\CertificatesController@form17lc')->name('form17lc');
    Route::post('/form17lc/issue', 'Web\Admin\CertificatesController@form17lc_issue')->name('form17lc.issue');
    Route::post('/form17lc/issue/print', 'Web\Admin\CertificatesController@form17lc_issue_print')->name('form17lc.issue.print');
    Route::get('/form17lc/view/{id}', 'Web\Admin\CertificatesController@form17lc_view')->name('form17lc.view');
    Route::get('/form17lc/edit/{id}', 'Web\Admin\CertificatesController@form17lc_edit')->name('form17lc.edit');
    Route::post('/form17lc/editlc', 'Web\Admin\CertificatesController@form17lc_editlc')->name('form17lc.editlc');
    Route::get('/form17lc/delete/{id}', 'Web\Admin\CertificatesController@form17lc_delete')->name('form17lc.delete');
    Route::get('/form17lc/print/{id}', 'Web\Admin\CertificatesController@form17lc_print')->name('form17lc.print');

});
