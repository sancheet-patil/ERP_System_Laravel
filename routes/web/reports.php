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
    Route::get('/studentbonafidereport', 'Web\Admin\ReportsController@studentbonafidereport')->name('studentbonafidereport');
    Route::post('/studentbonafidereport', 'Web\Admin\ReportsController@studentbonafidereport_post')->name('studentbonafidereport.post');
    Route::get('/bonafidereportexcel', 'Web\Admin\ReportsController@bonafidereportexcel')->name('bonafidereportexcel');

    Route::get('/lcissuereport', 'Web\Admin\ReportsController@lcissuereport')->name('lcissuereport');
    Route::post('/lcissuereport', 'Web\Admin\ReportsController@lcissuereport_post')->name('lcissuereport.post');
    Route::get('/lcissuereportexcel', 'Web\Admin\ReportsController@lcissuereportexcel')->name('lcissuereportexcel');

    Route::get('/form17lcissuereport', 'Web\Admin\ReportsController@form17lcissuereport')->name('form17lcissuereport');
    Route::post('/form17lcissuereport', 'Web\Admin\ReportsController@form17lcissuereport_post')->name('form17lcissuereport.post');
    Route::get('/form17lcissuereportexcel', 'Web\Admin\ReportsController@form17lcissuereportexcel')->name('form17lcissuereportexcel');

    Route::get('/studentreport', 'Web\Admin\ReportsController@studentreport')->name('studentreport');
    Route::post('/studentreport', 'Web\Admin\ReportsController@studentreport_post')->name('studentreport.post');
    Route::get('/studentreportexcel', 'Web\Admin\ReportsController@studentreportexcel')->name('studentreportexcel');
    Route::get('/studentcustomreportexcel', 'Web\Admin\ReportsController@studentcustomreportexcel')->name('studentcustomreportexcel');

    Route::get('/form17studentreport', 'Web\Admin\ReportsController@form17studentreport')->name('form17studentreport');
    Route::post('/form17studentreport', 'Web\Admin\ReportsController@form17studentreport_post')->name('form17studentreport.post');
    Route::get('/form17studentreportexcel', 'Web\Admin\ReportsController@form17studentreportexcel')->name('form17studentreportexcel');

    Route::get('/castewisestaffreport', 'Web\Admin\ReportsController@castewisestaffreport')->name('castewisestaffreport');
    Route::post('/castewisestaffreport', 'Web\Admin\ReportsController@castewisestaffreport_post')->name('castewisestaffreport.post');
    Route::get('/castewisestaffreportexcel', 'Web\Admin\ReportsController@castewisestaffreportexcel')->name('castewisestaffreportexcel');

    Route::get('/genderwisestaffreport', 'Web\Admin\ReportsController@genderwisestaffreport')->name('genderwisestaffreport');
    Route::post('/genderwisestaffreport', 'Web\Admin\ReportsController@genderwisestaffreport_post')->name('genderwisestaffreport.post');
    Route::get('/genderwisestaffreportexcel', 'Web\Admin\ReportsController@genderwisestaffreportexcel')->name('genderwisestaffreportexcel');

    Route::get('/studentcataloguereport', 'Web\Admin\ReportsController@studentcataloguereport')->name('studentcataloguereport');
    Route::post('/studentcataloguereport', 'Web\Admin\ReportsController@studentcataloguereport_post')->name('studentcataloguereport.post');
    Route::get('/studentcataloguereportexcel', 'Web\Admin\ReportsController@studentcataloguereportexcel')->name('studentcataloguereportexcel');

    Route::get('/staffcataloguereport', 'Web\Admin\ReportsController@staffcataloguereport')->name('staffcataloguereport');
    Route::get('/staffcataloguereportexcel', 'Web\Admin\ReportsController@staffcataloguereportexcel')->name('staffcataloguereportexcel');

    Route::get('/studentattendanceataloguereport', 'Web\Admin\ReportsController@studentattendanceataloguereport')->name('studentattendanceataloguereport');
    Route::post('/studentattendanceataloguereport', 'Web\Admin\ReportsController@studentattendanceataloguereport_post')->name('studentattendanceataloguereport.post');
    Route::get('/studentattendanceataloguereport/details', 'Web\Admin\ReportsController@studentattendanceataloguereport_details')->name('studentattendanceataloguereport.details');
    Route::get('/studentattendanceataloguereport/summary', 'Web\Admin\ReportsController@studentattendanceataloguereport_summary')->name('studentattendanceataloguereport.summary');
    Route::get('/studentcataloguereport/studiesofmonth', 'Web\Admin\ReportsController@studentcataloguereport_studiesofmonth')->name('studentcataloguereport.studiesofmonth');

    Route::get('/examinationreport1to7', 'Web\Admin\ReportsController@examinationreport1to7')->name('examinationreport1to7');
    Route::post('/examinationreport1to7', 'Web\Admin\ReportsController@examinationreport1to7_post')->name('examinationreport1to7.post');
    Route::get('/examinationreport8to10', 'Web\Admin\ReportsController@examinationreport8to10')->name('examinationreport8to10');
    Route::post('/examinationreport8to10', 'Web\Admin\ReportsController@examinationreport8to10_post')->name('examinationreport8to10.post');
    Route::get('/examinationreport11to12', 'Web\Admin\ReportsController@examinationreport11to12')->name('examinationreport11to12');
    Route::post('/examinationreport11to12', 'Web\Admin\ReportsController@examinationreport11to12_post')->name('examinationreport11to12.post');

    Route::get('/examinationreport1to7/print', 'Web\Admin\ReportsController@examinationreport1to7_print')->name('examinationreport1to7.print');
    Route::get('/examinationreport8to10/print', 'Web\Admin\ReportsController@examinationreport8to10_print')->name('examinationreport8to10.print');
    Route::get('/examinationreport11to12/print', 'Web\Admin\ReportsController@examinationreport11to12_print')->name('examinationreport11to12.print');

    Route::get('/circularreport', 'Web\Admin\ReportsController@circularreport')->name('circularreport');
    Route::post('/circularreport', 'Web\Admin\ReportsController@circularreport_post')->name('circularreport.post');
    Route::get('/circularreportexcel', 'Web\Admin\ReportsController@circularreportexcel')->name('circularreportexcel');

    Route::get('/inwardsreport', 'Web\Admin\ReportsController@inwardsreport')->name('inwardsreport');
    Route::post('/inwardsreport', 'Web\Admin\ReportsController@inwardsreport_post')->name('inwardsreport.post');
    Route::get('/inwardsreportexcel', 'Web\Admin\ReportsController@inwardsreportexcel')->name('inwardsreportexcel');

    Route::get('/outwardsreport', 'Web\Admin\ReportsController@outwardsreport')->name('outwardsreport');
    Route::post('/outwardsreport', 'Web\Admin\ReportsController@outwardsreport_post')->name('outwardsreport.post');
    Route::get('/outwardsreportexcel', 'Web\Admin\ReportsController@outwardsreportexcel')->name('outwardsreportexcel');

    Route::get('/visitorsreport', 'Web\Admin\ReportsController@visitorsreport')->name('visitorsreport');
    Route::post('/visitorsreport', 'Web\Admin\ReportsController@visitorsreport_post')->name('visitorsreport.post');
    Route::get('/visitorsreportexcel', 'Web\Admin\ReportsController@visitorsreportexcel')->name('visitorsreportexcel');

    Route::get('/studentscholarshipreport', 'Web\Admin\ReportsController@studentscholarshipreport')->name('studentscholarshipreport');
    Route::post('/studentscholarshipreport', 'Web\Admin\ReportsController@studentscholarshipreport_post')->name('studentscholarshipreport.post');
    Route::get('/studentscholarshipreportexcel', 'Web\Admin\ReportsController@studentscholarshipreportexcel')->name('studentscholarshipreportexcel');
});
